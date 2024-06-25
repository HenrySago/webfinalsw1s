<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Carbon\Carbon;
use App\Models\Ciudad;
use DB;
use Session;


class GoogleCloudVisionController extends Controller
{
  
   
    public function analizarImagen(Request $request)
    {
        try {
            $data = "";
            $imagen = $request->file('imagen');
            $idCiudad = $request->input('idCiudad');
            $ciudad = Ciudad::findOrFail($idCiudad);
            $digitosEnterosMedidor = $ciudad->digitosEnterosMedidor;
            $digitosDecimalesMedidor = $ciudad->digitosDecimalesMedidor;
            $digitosTotales = $digitosEnterosMedidor + $digitosDecimalesMedidor;

            if(!$imagen){
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Seleccione una imagen','data'=>null]);   
            }

            $image = base64_encode(file_get_contents($imagen));

            $imageAnnotatorClient = new ImageAnnotatorClient([
            'credentials'=> base_path().'/database/data/lectormedidor-52c04-b2262ed5715c.json'
            ]);
         
            
            $response = $imageAnnotatorClient->textDetection(file_get_contents($imagen));
            $text = $response->getTextAnnotations();
            $data = $text[0]->getDescription();
         
            $data = preg_replace("/<br>|\n/", "", $data );
            $data = str_replace(" ", "", $data);
            $data = preg_replace('/[^0-9]/', '', $data);
            $numeroDigitosLeidos = strlen($data);

            if($digitosTotales!=$numeroDigitosLeidos){
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'La ciudad '.$ciudad->nombre.' tiene configurado '.$digitosTotales.' digitos del medidor y se logro leer '.$numeroDigitosLeidos.' digitos','data'=>'']); 
            }
            
            if ($error = $response->getError()) {
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>$error->getMessage()]);  
            }
         
            $imageAnnotatorClient->close();

            return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>$data]); 
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>'No hay resultados']);   
        }
    }

}
