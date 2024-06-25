<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Medicion;
use App\Models\Factura;
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



}
