<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Medicion;
use App\Models\Ciudad;
use App\Models\Mensualidad;
use App\Models\Colaborador;
use App\Exports\MedicionExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class MedicionController extends Controller
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
    
    public function index(Request $request)
    {
        $mediciones = Medicion::_searchMediciones();
        return view('medicion.index',['mediciones'=>$mediciones,'colaboradores'=>Colaborador::_getColaboradores(),'mensualidades'=>Mensualidad::_getTodosMensualidades(),'ciudades'=>Ciudad::_getCiudades()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idmedicion)
    {
        $medicion = Medicion::findOrFail($idmedicion);
        return view('medicion.show',['medicion'=>$medicion,'gmpasKey'=>env('GMAPS_KEY')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idmedicion)
    {        
        $medicion = Medicion::findOrFail($idmedicion);
        return view('medicion.edit',['medicion'=>$medicion,'colaboradores'=>Colaborador::_getColaboradoresPorCiudad($medicion->cliente->ciudad->id),'gmpasKey'=>env('GMAPS_KEY')]);
    }

    public function create()
    {        
       return view('medicion.create',['mensualidades'=>Mensualidad::_getTodosMensualidades(),'ciudades'=>Ciudad::_getCiudades()]);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $medicion = Medicion::createMedicion($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Medicion registrada correctamente']);

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
            $medicion = Medicion::updateMedicion($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Medicion actualizada correctamente']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }    
    }


    public function search(Request $request)
    {
        $idCiudad = $request->input('idCiudad');
        $idMensualidad = $request->input('idMensualidad');
        $idColaborador = $request->input('idColaborador');
        $estado = $request->input('estado');
        $mediciones = Medicion::_searchMediciones($idCiudad,$idMensualidad,$idColaborador,$estado);
        $view = view('medicion.search', ['mediciones'=>$mediciones]);
        return Response($view);
    }


    public function medicionExcel($idCiudad,$idMensualidad,$idColaborador,$estado) 
    {
        return Excel::download(new MedicionExport($idCiudad,$idMensualidad,$idColaborador,$estado), 'Medicion'.uniqid().'.xlsx');
    }

 

}
