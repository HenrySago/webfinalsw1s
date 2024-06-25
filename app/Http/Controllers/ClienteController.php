<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\Ciudad;
use DB;

class ClienteController extends Controller
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
            $nombreArchivo = "assets/contador/cliente.txt";
           if (!file_exists($nombreArchivo)) {
                touch($nombreArchivo);
            }
            $contenido = trim(file_get_contents($nombreArchivo));
            if ($contenido == "") {
                $visitas = 0;
            } else {
                $visitas = intval($contenido);
            }
            $visitas++;
            file_put_contents($nombreArchivo, $visitas);
        return view('cliente.index',['clientes'=>Cliente::_getClientes(),'visitas'=>$visitas]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idcliente)
    {
        $cliente = Cliente::findOrFail($idcliente);
        return view('cliente.show',['cliente'=>$cliente,'gmpasKey'=>env('GMAPS_KEY')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idcliente)
    {        
       return view('cliente.edit',['ciudades'=>Ciudad::_getCiudades(),'cliente'=>Cliente::findOrFail($idcliente),'gmpasKey'=>env('GMAPS_KEY')]);
    }

    public function create()
    {        
       return view('cliente.create',['ciudades'=>Ciudad::_getCiudades(),'gmpasKey'=>env('GMAPS_KEY')]);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!Cliente::verificarEmailExiste($request) && !Colaborador::verificarEmailExiste($request)) {
                $cliente = Cliente::createCliente($request);
                $destinationPath = Cliente::createDirectorioPorIdCliente($cliente->id);
                Cliente::actualizarPerfilPorIdCliente($request,$cliente->id,$destinationPath);
            }else{
                return response()->json(['codigo'=>1, 'mensaje'=>'El correo ingresado alguien lo esta ocupando, por favor comuniquese con soporte.']);
            }
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Cliente registrado correctamente']);

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
            if (!Cliente::verificarEmailExisteMenosClienteAEditar($request) && !Colaborador::verificarEmailExiste($request)) {

                if ($request->input('password')) {
                    if (trim($request->input('password'))!='') {
                        $cliente = Cliente::updateCliente($request);
                        $destinationPath = Cliente::createDirectorioPorIdCliente($cliente->id);
                        Cliente::actualizarPerfilPorIdCliente($request,$cliente->id,$destinationPath);  
                    }else{
                        return response()->json(['codigo'=>1, 'mensaje'=>'El password ingresado tiene caracteres no validos']);
                    }                     
                }else{
                        $cliente = Cliente::updateCliente($request);
                        $destinationPath = Cliente::createDirectorioPorIdCliente($cliente->id);
                        Cliente::actualizarPerfilPorIdCliente($request,$cliente->id,$destinationPath);
                }
             
            }else{
                return response()->json(['codigo'=>1, 'mensaje'=>'El correo ingresado alguien lo esta ocupando, por favor comuniquese con soporte.']);
            }
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Datos del cliente actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        } 
    }


    public function search(Request $request)
    {
        $clientes = Cliente::_searchClientes($request);
        $view = view('cliente.search', ['clientes'=>$clientes]);
        return Response($view);
    }

    public function updateEstado(Request $request)
    {
        try {
            DB::beginTransaction();
            Cliente::updateEstado($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Estado del cliente actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }    
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            Cliente::deleteCliente($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Cliente eliminado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }


}
