<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Ciudad;
use File;

class CiudadController extends Controller
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
        return view('ciudad.index',['ciudades'=>Ciudad::_getCiudades()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $json_stylemap = File::get(base_path().'/database/data/stylemap.json');
        $stylemap = json_decode($json_stylemap);
        return view('ciudad.create',['stylemap'=>$stylemap]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $ciudad = Ciudad::createCiudad($request);
            $destinationPath = Ciudad::createDirectorioPorIdCiudad($ciudad->id);
            Ciudad::updateBanderaPorIdCiudad($request,$ciudad->id,$destinationPath);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Ciudad registrada correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idciudad)
    {
        return view('ciudad.show',['ciudad'=>Ciudad::findOrFail($idciudad)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idciudad)
    {
        return view('ciudad.edit',['ciudad'=>Ciudad::findOrFail($idciudad)]);
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
            $ciudad = Ciudad::updateCiudad($request);
            $destinationPath = Ciudad::createDirectorioPorIdCiudad($ciudad->id);
            Ciudad::updateBanderaPorIdCiudad($request,$ciudad->id,$destinationPath);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Ciudad editada correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            Ciudad::deleteCiudad($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Ciudad eliminada correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }



    public function updateEstado(Request $request)
    {
        try {
            DB::beginTransaction();
            PoligonoCiudad::updateEstado($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Estado del poligono actualizado correctamente']);                
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }



}
