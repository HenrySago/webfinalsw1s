<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Ciudad;
use Carbon\Carbon;
use DB;

class CiudadController extends Controller
{
    
    public function precioMensualidad(Request $request)
    {
        try {
            $idCiudad = $request->input('idCiudad');
            $idCliente = $request->input('idCliente');
            $consumo = $request->input('consumo');
            $consumoTarifa = Ciudad::obtenerPrecioPorIdCiudadIdClienteYConsumo($idCiudad,$idCliente,$consumo);
            return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>$consumoTarifa]); 
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>null]);   
        }
    }





}
