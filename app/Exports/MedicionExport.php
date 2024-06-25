<?php

namespace App\Exports;

use App\Models\Medicion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class MedicionExport implements FromView
{

    protected $idCiudad;
    protected $idMensualidad;
    protected $idColaborador;
    protected $estado;

    
    public function __construct($idCiudad,$idMensualidad,$idColaborador,$estado)
    {
        $this->idCiudad = $idCiudad;
        $this->idMensualidad = $idMensualidad;
        $this->idColaborador = $idColaborador;
        $this->estado = $estado;
    }

    public function view(): View
    {
        return view('export.medicion', [
            'mediciones' => Medicion::_getTodasMediciones($this->idCiudad,$this->idMensualidad,$this->idColaborador,$this->estado)
        ]);
    }
}
