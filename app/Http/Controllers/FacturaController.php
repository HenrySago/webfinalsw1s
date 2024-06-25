<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Factura;
use App\Models\Ciudad;
use App\Models\Mensualidad;
use App\Models\Colaborador;
use App\Exports\FacturaExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class FacturaController extends Controller
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
        $facturas = Factura::_searchFacturas();
        return view('factura.index',['facturas'=>$facturas,'colaboradores'=>Colaborador::_getColaboradores(),'mensualidades'=>Mensualidad::_getTodosMensualidades(),'ciudades'=>Ciudad::_getCiudades()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idfactura)
    {
        $factura = Factura::findOrFail($idfactura);
        return view('factura.show',['factura'=>$factura,'gmpasKey'=>env('GMAPS_KEY')]);
    }


    public function search(Request $request)
    {
        $idCiudad = $request->input('idCiudad');
        $idMensualidad = $request->input('idMensualidad');
        $idColaborador = $request->input('idColaborador');
        $estado = $request->input('estado');
       
        $facturas = Factura::_searchFacturas($idCiudad,$idMensualidad,$idColaborador,$estado);
        $view = view('factura.search', ['facturas'=>$facturas]);
        return Response($view);
    }


    public function facturaExcel($idCiudad,$idMensualidad,$idColaborador,$pagado) 
    {
        return Excel::download(new FacturaExport($idCiudad,$idMensualidad,$idColaborador,$pagado), 'Factura'.uniqid().'.xlsx');
    }

 

}
