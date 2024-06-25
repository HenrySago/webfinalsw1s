<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Colaborador;
use App\Models\Cliente;
use App\Models\Ciudad;
use DB;

class ColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('colaborador.index',['colaboradores'=>Colaborador::_getColaboradores()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idcolaborador)
    {
        $colaborador = Colaborador::findOrFail($idcolaborador);
        return view('colaborador.show',['colaborador'=>$colaborador]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idcolaborador)
    {        
       return view('colaborador.edit',['ciudades'=>Ciudad::_getCiudades(),'colaborador'=>Colaborador::findOrFail($idcolaborador)]);
    }

    public function create()
    {        
       return view('colaborador.create',['ciudades'=>Ciudad::_getCiudades()]);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Colaborador::verificarEmailExiste($request) && !Cliente::verificarEmailExiste($request)) {
                $usuario = Colaborador::createColaborador($request);
                $destinationPath = Colaborador::createDirectorioPorIdColaborador($usuario->id);
                Colaborador::actualizarPerfilPorIdColaborador($request,$usuario->id,$destinationPath);
            }else{
                return response()->json(['codigo'=>1, 'mensaje'=>'El correo ingresado alguien lo esta ocupando, por favor comuniquese con soporte.']);
            }
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Colaborador registrado correctamente']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }      
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Colaborador::verificarEmailExisteMenosColaboradorAEditar($request) && !Cliente::verificarEmailExiste($request)) {

                if ($request->input('password')) {
                    if (trim($request->input('password'))!='') {
                        $usuario = Colaborador::updateColaborador($request);
                        $destinationPath = Colaborador::createDirectorioPorIdColaborador($usuario->id);
                        Colaborador::actualizarPerfilPorIdColaborador($request,$usuario->id,$destinationPath);  
                    }else{
                        return response()->json(['codigo'=>1, 'mensaje'=>'El password ingresado tiene caracteres no validos']);
                    }                     
                }else{
                        $usuario = Colaborador::updateColaborador($request);
                        $destinationPath = Colaborador::createDirectorioPorIdColaborador($usuario->id);
                        Colaborador::actualizarPerfilPorIdColaborador($request,$usuario->id,$destinationPath);
                }
             
            }else{
                return response()->json(['codigo'=>1, 'mensaje'=>'El correo ingresado alguien lo esta ocupando, por favor comuniquese con soporte.']);
            }
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Datos del colaborador actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        } 
    }


    public function search(Request $request)
    {
        $colaboradores = Colaborador::_searchColaboradores($request);
        $view = view('colaborador.search', ['colaboradores'=>$colaboradores]);
        return Response($view);
    }

    public function updateEstado(Request $request)
    {
        try {
            DB::beginTransaction();
            Colaborador::updateEstado($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Estado del colaborador actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }    
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            Colaborador::deleteColaborador($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Colaborador eliminado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }


}
