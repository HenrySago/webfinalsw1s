<?php

namespace App\Exports;

use App\Models\Factura;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class FacturaExport implements FromView
{

    protected $idCiudad;
    protected $idMensualidad;
    protected $idColaborador;
    protected $pagado;

    
    public function __construct($idCiudad,$idMensualidad,$idColaborador,$pagado)
    {
        $this->idCiudad = $idCiudad;
        $this->idMensualidad = $idMensualidad;
        $this->idColaborador = $idColaborador;
        $this->pagado = $pagado;
    }

    public function view(): View
    {
        return view('export.factura', [
            'facturas' => Factura::_getTodasFacturas($this->idCiudad,$this->idMensualidad,$this->idColaborador,$this->pagado)
        ]);
    }
}
