<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Cliente;
use App\Models\Colaborador;
use Carbon\Carbon;
use DB;

class ClienteController extends Controller
{
    
    public function login(Request $request)
    {
        try {
            $correo = $request->input('correo');
            $password = $request->input('password');
            $cliente = Cliente::login($correo,$password);
            if ($cliente) {
                return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>$cliente]);                
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
            $idCliente = $request->input('idCliente');
            $tokenFirebase = $request->input('tokenFirebase');

            if (Cliente::verificarSiExisteClientePorId($idCliente)) {
                Cliente::registrarDispositivo($idCliente,$tokenFirebase);
                return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>'Dispositivo registrado correctamente.']);                
            }else{
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'El cliente no existe, lo sentimos.','data'=>null]);   
            }
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>null]);   
        }
    }


    public function enviarCodigoRecuperacionPassword(Request $request)
    {
        try {
            $correo = $request->input('correo');
            $cliente = Cliente::obtenerClientePorCorreo($correo);
            $colaborador = Colaborador::obtenerColaboradorPorCorreo($correo);

            if ($cliente) {
                Cliente::enviarCodigoRecuperacionPasswordPorIdCliente($cliente->id);
                return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>'Codigo enviado al correo del cliente']);                
            }else if($colaborador){
                Colaborador::enviarCodigoRecuperacionPasswordPorIdColaborador($colaborador->id);
                return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>'Codigo enviado al correo del colaborador']); 
            }else{
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'El correo ingresado no fue encontrado o el usuario esta inhabilitado.','data'=>null]);   
            }
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>null]);   
        }
    }

    public function validarCodigoRecuperacionPassword(Request $request)
    {
        try {
            $correo = $request->input('correo');
            $codigo = $request->input('codigo');

            if(trim($codigo)=="" || strlen($codigo)<4 || strlen($codigo)>4){
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'El codigo ingresado no es valido.','data'=>'']);
            }

            $cliente = Cliente::obtenerClientePorCorreoYCodigo($correo,$codigo);
            $colaborador = Colaborador::obtenerColaboradorPorCorreoYCodigo($correo,$codigo);

            if ($cliente) {
                Cliente::borrarCodigoRecuperacionPasswordPorIdCliente($cliente->id);
                return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>'Codigo validado correctamente']);                
            }else if($colaborador){
                Colaborador::borrarCodigoRecuperacionPasswordPorIdColaborador($colaborador->id);
                return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>'Codigo validado correctamente']);    
            }else{
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'El codigo es invalido.','data'=>null]);   
            }
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>'']);   
        }
    }


    public function nuevoPassword(Request $request)
    {
        try {
            $correo = $request->input('correo');
            $password = $request->input('password');
            $repetirPassword = $request->input('repetirPassword');

            if(trim($password)!=trim($repetirPassword)){
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Las contraseñas ingresadas no coinciden.','data'=>null]);
            }

            $cliente = Cliente::obtenerClientePorCorreo($correo);
            $colaborador = Colaborador::obtenerColaboradorPorCorreo($correo);

            if ($cliente) {
                Cliente::cambiarPasswordPorIdCliente($cliente->id,$password);
                return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>'Contraseña recuperada correctamente']);                
            }else if($colaborador){
                Colaborador::cambiarPasswordPorIdColaborador($colaborador->id,$password);
                return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Consulta realizada correctamente','data'=>'Contraseña recuperada correctamente']); 
            }else{
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'El correo ingresado no fue encontrado o el usuario esta inhabilitado.','data'=>null]);   
            }
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>null]);   
        }
    }




    public function editarPerfil(Request $request)
    {
        try {
            $idCliente = $request->input('idCliente');
            $nombres = $request->input('nombres');
            $apellidos = $request->input('apellidos');
            $nit = $request->input('nit');
            $nombreFactura = $request->input('nombreFactura');
            $perfil = $request->file('perfil');

            $cliente = Cliente::findOrFail($idCliente);
            if ($cliente) {
                $cliente = Cliente::actualizarDatos($idCliente,$nombres,$apellidos,$nit,$nombreFactura,$perfil);
                return response()->json(['codigo'=>0, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'Datos del cliente actualizado correctamente','data'=>$cliente]);                
            }else{
                return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>'El cliente no fue encontrado o el usuario esta inhabilitado.','data'=>null]);   
            }
        } catch (\Exception $e) {
           return response()->json(['codigo'=>1, 'fecha'=>Carbon::now()->toDateTimeLocalString(), 'mensaje'=>$e->getMessage(),'data'=>null]);   
        }
    }








}
