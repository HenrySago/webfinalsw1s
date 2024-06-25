<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Medicion;
use App\Models\Factura;
use App\Models\Colaborador;
use App\Models\Ciudad;
use App\Models\Cliente;
use App\Models\Mensualidad;
use Carbon\Carbon;
use DB;

class ReporteController extends Controller
{
    
    public function reporteMedicion($idMedicion)
    {
        $medicion = Medicion::obtenerMedicionPorId($idMedicion);
        $view =  \View::make('reporte.reporte-medicion', compact('medicion'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream(); 
    }

    public function reporteFactura($idFactura)
    {
        $factura = Factura::obtenerFacturaPorId($idFactura);
        $view =  \View::make('reporte.reporte-factura', compact('factura'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream(); 
    }

    public function reporteGeneral()
    {
        return view('reporte.reporte-general-formulario',['colaboradores'=>Colaborador::_getColaboradores(),'mensualidades'=>Mensualidad::_getTodosMensualidades(),'ciudades'=>Ciudad::_getCiudades(),'clientes'=>Cliente::_getTodosClientes()]); 
    }


    public function generarReporteGeneral($idCiudad,$idMensualidad,$idColaborador,$idCliente,$estado,$pagado)
    {
        $mediciones = Medicion::_reporteMediciones($idCiudad,$idMensualidad,$idColaborador,$idCliente,$estado,$pagado);
        $view =  \View::make('reporte.reporte-general', compact('mediciones'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream();
    }





}
