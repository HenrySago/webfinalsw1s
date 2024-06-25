<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Auth;
use File;
use DB;
use App\Models\Colaborador;
use App\Models\Cliente;
use App\Models\Mensualidad;
use App\Models\Medicion;
use App\Models\FirebaseNotificacion;
use App\Models\Pago;


class Factura extends Model
{
    protected $table='factura';

    protected $primaryKey='id';

    public $timestamps=true;


    protected $fillable =[
        'idMedicion',
        'pagado',
        'token'
    ];

    protected $guarded =[

    ];


    //SCOPES
    public function scope_getFacturas($query)
    {
        return $query->orderBy('id','desc')->paginate(10);
    }
    public function scope_getFacturasPorCiudadYPorMensualidad($query,$idCiudad,$idMensualidad)
    {
        return $query->select('factura.*')
        ->join('medicion','medicion.id','factura.idMedicion')
        ->join('cliente','cliente.id','medicion.idCliente')
        ->join('ciudad','ciudad.id','cliente.idCiudad')
        ->where('ciudad.id',$idCiudad)
        ->where('medicion.idMensualidad',$idMensualidad)
        ->orderBy('factura.id','desc')->get();
    }


    public function scope_searchFacturas($query,$idCiudad=-1,$idMensualidad=-1,$idColaborador=-1,$estado=-1)
    {
        $query = $query->select('factura.*')
        ->join('medicion','medicion.id','factura.idMedicion')
        ->join('cliente','cliente.id','medicion.idCliente')
        ->join('ciudad','ciudad.id','cliente.idCiudad');

        if($idCiudad!=-1){
            $query = $query->where('ciudad.id',$idCiudad);
        }
        if($idMensualidad!=-1){
            $query = $query->where('medicion.idMensualidad',$idMensualidad);
        }
        if($idColaborador!=-1){
            $query = $query->where('medicion.idColaborador',$idColaborador);
        }
        if($estado!=-1){
            $query = $query->where('factura.pagado',$estado);
        }
        return $query->orderBy('factura.id','desc')->get();
    }


    public function scope_getTodasFacturas($query,$idCiudad,$idMensualidad,$idColaborador,$pagado)
    {
        $query = $query->select('factura.*')
        ->join('medicion','medicion.id','factura.idMedicion')
        ->join('cliente','cliente.id','medicion.idCliente')
        ->join('ciudad','ciudad.id','cliente.idCiudad');

        if($idCiudad!=-1){
            $query = $query->where('ciudad.id',$idCiudad);
        }
        if($idMensualidad!=-1){
            $query = $query->where('medicion.idMensualidad',$idMensualidad);
        }
        if($idColaborador!=-1){
            $query = $query->where('medicion.idColaborador',$idColaborador);
        }
        if($pagado!=-1){
            $query = $query->where('factura.pagado',$pagado);
        }

        return $query->orderBy('factura.id','desc')->get();
    }

    //RELATIONSHIPS
    public function medicion()
    {
        return $this->belongsTo('App\Models\Medicion','idMedicion','id')->with('mensualidad')->with('cliente');
    }



    //STATICS
    public static function getNumeroFacturas()
    {
        return Factura::get()->count();
    }


    public static function obtenerFacturaPorToken($token)
    {
        return Factura::with('medicion')->where('token',$token)->first();
    }


    //WEB SEVICES

    public static function listarFacturasPorIdClienteYPagado($idCliente,$pagado)
    {
        return Factura::with('medicion')->whereHas('medicion', function ($query) use ($idCliente){
                                        $query->where('medicion.idCliente', $idCliente);
                                    })->where('pagado',$pagado)->get();
    }

    public static function generarFactura($idMedicion,$consumo)
    {

        $medicion = Medicion::findOrFail($idMedicion);
        $colaborador = Colaborador::findOrFail($medicion->idColaborador);
        $cliente = Cliente::findOrFail($medicion->idCliente);

        $datos = Ciudad::obtenerPrecioPorIdCiudadIdClienteYConsumo($cliente->idCiudad,$cliente->id,$consumo);

        $medicion->estado = 1;
        $medicion->consumo = $datos['consumo'];
        $medicion->consumoReal = $datos['consumoReal'];
        $medicion->total = $datos['costo'];
        $medicion->update();

        $factura = new Factura;
        $factura->idMedicion = $idMedicion;
        $factura->pagado = 0;
        $factura->token = sha1(time());
        $factura->save();

        $notificacion = new FirebaseNotificacion;
        $notificacion->enviarNotificacion('📝 Factura pendiente','Factura nro. '.$factura->id,$cliente->tokenFirebase,1,$factura->id);
        return $factura;
    }

   public static function verificarSiExisteFacturaPorMedicionId($idMedicion)
    {
        $factura = Factura::where('idMedicion',$idMedicion)->first();
        return $factura;
    }

    public static function obtenerFacturaPorId($idFactura)
    {
        return Factura::with('medicion')->where('id',$idFactura)->first();
    }

   public static function marcarFacturaComoPagada($token,$identificador)
    {
        $factura = Factura::where('token',$token)->first();
        $factura->pagado = 1;
        $factura->update();

        $factura = Factura::obtenerFacturaPorId($factura->id);

        Pago::createPago($factura->id,$identificador,$token);
        $notificacion = new FirebaseNotificacion;
        $notificacion->enviarNotificacion(' 💵 Factura pagada correctamente','Factura nro. '.$factura->id,$factura->medicion->cliente->tokenFirebase,1,$factura->id);
    }





}

