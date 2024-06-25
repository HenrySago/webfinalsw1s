<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Colaborador;
use Carbon\Carbon;
use DB;

class ColaboradorController extends Controller
{
    
    public function login(Request $request)
    {
        try {
            $correo = $request->input('correo');
            $password = $request->input('password');
            $colaborador = Colaborador::login($correo,$password);
            if ($colaborador) {
                return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>$colaborador]);                
            }else{
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'El correo y contraseña incorrectos.','data'=>null]);   
            }
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>null]);   
        }
    }


    public function registroDispositivo(Request $request)
    {
        try {
            $idColaborador = $request->input('idColaborador');
            $tokenFirebase = $request->input('tokenFirebase');

            if (Colaborador::verificarSiExisteColaboradorPorId($idColaborador)) {
                Colaborador::registrarDispositivo($idColaborador,$tokenFirebase);
                return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>'Dispositivo registrado correctamente.']);                
            }else{
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'El colaborador no existe, lo sentimos.','data'=>null]);   
            }
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage().' '.$e->getLine(),'data'=>null]);   
        }
    }



    public function editarPerfil(Request $request)
    {
        try {
            $idColaborador = $request->input('idColaborador');
            $nombres = $request->input('nombres');
            $apellidos = $request->input('apellidos');
            $perfil = $request->file('perfil');

            $colaborador = Colaborador::findOrFail($idColaborador);
            if ($colaborador) {
                $colaborador = Colaborador::actualizarDatos($idColaborador,$nombres,$apellidos,$perfil);
                return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Datos del colaborador actualizado correctamente','data'=>$colaborador]);                
            }else{
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'El colaborador no fue encontrado o el usuario esta inhabilitado.','data'=>null]);   
            }
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>null]);   
        }
    }





}
