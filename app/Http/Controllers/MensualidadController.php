<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Mensualidad;
use App\Models\Gestion;
use DB;

class MensualidadController extends Controller
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
        return view('mensualidad.index',['mensualidades'=>Mensualidad::_getMensualidades()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idmensualidad)
    {
        $mensualidad = Mensualidad::findOrFail($idmensualidad);
        return view('mensualidad.show',['mensualidad'=>$mensualidad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idmensualidad)
    {        
       return view('mensualidad.edit',['mensualidad'=>Mensualidad::findOrFail($idmensualidad),'gestiones'=>Gestion::_getTodasGestiones()]);
    }

    public function create()
    {        
       return view('mensualidad.create',['gestiones'=>Gestion::_getTodasGestiones()]);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $mensualidad = Mensualidad::createMensualidad($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Mensualidad registrada correctamente']);

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
            $mensualidad = Mensualidad::updateMensualidad($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Mensualidad actualizada correctamente']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }    
    }


    public function search(Request $request)
    {
        $mensualidades = Mensualidad::_searchMensualidades($request);
        $view = view('mensualidad.search', ['mensualidades'=>$mensualidades]);
        return Response($view);
    }


    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            Mensualidad::deleteMensualidad($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Mensualidad eliminada correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }


}
