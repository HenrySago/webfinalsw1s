<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Factura;
use Carbon\Carbon;
use DB;

class FacturaController extends Controller
{
  
    
    public function listar(Request $request)
    {
        try {
            $idCliente = $request->input('idCliente');
            $pagado = $request->input('pagado');
            $facturas = Factura::listarFacturasPorIdClienteYPagado($idCliente,$pagado);
            return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>$facturas]); 
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>null]);   
        }
    }

    public function generarFactura(Request $request)
    {
        try {
            $idMedicion = $request->input('idMedicion');
            $consumo = $request->input('consumo');
            if(Factura::verificarSiExisteFacturaPorMedicionId($idMedicion)){
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Esta asignación ya tiene una factura generada','data'=>null]);   
            }
            Factura::generarFactura($idMedicion,$consumo);
            return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>'Factura generada correctamente']); 
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>null]);   
        }
    }





}
