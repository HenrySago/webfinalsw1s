<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Gestion;
use DB;

class GestionController extends Controller
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
        return view('gestion.index',['gestiones'=>Gestion::_getGestiones()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idgestion)
    {
        $gestion = Gestion::findOrFail($idgestion);
        return view('gestion.show',['gestion'=>$gestion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idgestion)
    {        
       return view('gestion.edit',['gestion'=>Gestion::findOrFail($idgestion)]);
    }

    public function create()
    {        
       return view('gestion.create');
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $gestion = Gestion::createGestion($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Gestion registrada correctamente']);

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
            $gestion = Gestion::updateGestion($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Gestion actualizada correctamente']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }    
    }


    public function search(Request $request)
    {
        $gestiones = Gestion::_searchGestiones($request);
        $view = view('gestion.search', ['gestiones'=>$gestiones]);
        return Response($view);
    }


    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            Gestion::deleteGestion($request);
            DB::commit();
            return response()->json(['codigo'=>0, 'mensaje'=>'Gestion eliminada correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['codigo'=>1, 'mensaje'=>$e->getMessage()]);
        }
    }


}
