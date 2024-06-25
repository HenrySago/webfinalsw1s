<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\FirebaseNotificacion;
use Carbon\Carbon;
use DB;

class NotificacionController extends Controller
{
    
    public function enviarNotificacion(Request $request)
    {
        try {
            $titulo = $request->input('titulo');
            $cuerpo = $request->input('cuerpo');
            $tokenFirebase = $request->input('tokenFirebase');
            $tipo = $request->input('tipo');
            $idContenido = $request->input('idContenido');

            $notificacion = new FirebaseNotificacion;
            $data = $notificacion->enviarNotificacion($titulo,$cuerpo,$tokenFirebase,$tipo,$idContenido);
            return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>$data]); 
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>null]);   
        }
    }


  


}
