<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\Medicion;
use Carbon\Carbon;
use DB;

class MedicionController extends Controller
{
    
    public function listar(Request $request)
    {
        try {
            $idColaborador = $request->input('idColaborador');
            $estado = $request->input('estado');
            $asignaciones = Medicion::listarAsignacionesPorIdColaboradorYEstado($idColaborador,$estado);
            return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>$asignaciones]); 
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>null]);   
        }
    }





}
