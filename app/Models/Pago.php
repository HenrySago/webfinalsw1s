<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use File;
use DB;


class Pago extends Model
{
    protected $table='pago';

    protected $primaryKey='id';

    public $timestamps=true;


    protected $fillable =[
		'idFactura',
        'identificador',
		'token',
		'estado'
    ];

    protected $guarded =[

    ];


    //SCOPES
    public function scope_getPagos($query)
    {
    	return $query->where('eliminado',0)->get();
    }


   
    //STATICS
    public static function createPago($idFactura,$identificador,$token)
    {
        $pago = new Pago;
        $pago->idFactura = $idFactura;
        $pago->identificador = $identificador;
        $pago->token = $token;
        $pago->estado = 1;
        $pago->save();
        return $pago;
    }

}
