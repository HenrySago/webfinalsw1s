<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Colaborador;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Medicion;
use App\Models\Ciudad;
use App\Models\Mensualidad;
use DB;

class DashboardController extends Controller
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
        $nombreArchivo = "assets/contador/home.txt";
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
       return view('dashboard.index',
        ['nro_colaboradores'=>Colaborador::getNumeroColaboradores(),
        'nro_clientes'=>Cliente::getNumeroClientes(),
        'nro_facturas'=>Factura::getNumeroFacturas(),
        'nro_mediciones'=>Medicion::getNumeroMediciones(),
        'mensualidades'=>Mensualidad::getTotalMensualidades(),
        'colaboradores'=>Colaborador::getColaboraresConMediciones(),
        'visitas'=>$visitas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idciudad)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idciudad)
    {
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

    }


}
