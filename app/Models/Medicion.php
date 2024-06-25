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
use App\Models\FirebaseNotificacion;


class Medicion extends Model
{
    protected $table='medicion';

    protected $primaryKey='id';

    public $timestamps=true;


    protected $fillable =[
        'latitud',
        'longitud',
        'direccion',
        'referencia',
        'consumo',
        'total',
        'idMensualidad',
        'idAdministrador',
        'idColaborador',
        'idCliente',
        'estado'
    ];

    protected $guarded =[

    ];


    //SCOPES
    public function scope_getMediciones($query)
    {
        return $query->orderBy('id','desc')->paginate(10);
    }

    public function scope_getMedicionesPorCiudadYPorMensualidad($query,$idCiudad,$idMensualidad)
    {
        return $query->select('medicion.*')
        ->join('cliente','cliente.id','medicion.idCliente')
        ->join('ciudad','ciudad.id','cliente.idCiudad')
        ->where('ciudad.id',$idCiudad)
        ->where('medicion.idMensualidad',$idMensualidad)
        ->orderBy('medicion.id','desc')->get();
    }


    public function scope_searchMediciones($query,$idCiudad=-1,$idMensualidad=-1,$idColaborador=-1,$estado=-1)
    {
        $query = $query->select('medicion.*')
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
            $query = $query->where('medicion.estado',$estado);
        }
        return $query->orderBy('medicion.id','desc')->get();
    }


    public function scope_reporteMediciones($query,$idCiudad=-1,$idMensualidad=-1,$idColaborador=-1,$idCliente=-1,$estado=-1,$pagado=-1)
    {
        $query = $query->select('medicion.*')
        ->leftJoin('factura','factura.idMedicion','medicion.id')
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
        if($idCliente!=-1){
            $query = $query->where('cliente.id',$idCliente);
        }
        if($estado!=-1){
            $query = $query->where('medicion.estado',$estado);
        }
        if($pagado!=-1){
            $query = $query->where('factura.pagado',$pagado);
        }
        return $query->orderBy('medicion.id','desc')->get();
    }


    public function scope_getTodasMediciones($query,$idCiudad,$idMensualidad,$idColaborador,$estado)
    {
        $query = $query->select('medicion.*')
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
            $query = $query->where('medicion.estado',$estado);
        }

        return $query->orderBy('medicion.id','desc')->get();
    }

    //RELATIONSHIPS
    public function mensualidad()
    {
        return $this->belongsTo('App\Models\Mensualidad','idMensualidad','id')->with('gestion');
    }
    public function administrador()
    {
        return $this->belongsTo('App\Models\Usuario','idAdministrador','id');
    }
    public function colaborador()
    {
        return $this->belongsTo('App\Models\Colaborador','idColaborador','id');
    }
    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente','idCliente','id');
    }
   public function factura()
    {
        return $this->hasOne('App\Models\Factura','idMedicion','id');
    }


    //STATICS
    public static function getNumeroMediciones()
    {
        return Medicion::get()->count();
    }



    public static function createMedicion($request)
    {
        $colaboradores = Colaborador::_getColaboradoresPorCiudad($request->input('idCiudad'));
        $clientes = Cliente::_getClientesPorCiudad($request->input('idCiudad'));
        $mediciones = Medicion::_getMedicionesPorCiudadYPorMensualidad($request->input('idCiudad'),$request->input('idMensualidad'));
        $indexMaxColaboradores = count($colaboradores)-1;
        $indexMaxClientes = count($clientes)-1;
        if($indexMaxColaboradores<0)
        {
            throw new \ErrorException('No hay colaboradores activos');
        }
        if($indexMaxClientes<0)
        {
            throw new \ErrorException('No hay clientes activos');
        }
        if(count($mediciones)>0){
            throw new \ErrorException('Ya se realizo el registro de mediciones de mensualidad para esta ciudad');
        }

        $indexColaboradores = 0;

        for ($i=0; $i <count($clientes) ; $i++) {

            $cliente = $clientes[$i];

            $colaborador = $colaboradores[$indexColaboradores];

            $medicion = new Medicion;
            $medicion->latitud = $cliente->latitud;
            $medicion->longitud = $cliente->longitud;
            $medicion->direccion = $cliente->direccion;
            $medicion->referencia = $cliente->referencia;
            $medicion->idMensualidad = $request->input('idMensualidad');
            $medicion->idAdministrador = Auth::user()->id;
            $medicion->idColaborador = $colaborador->id;
            $medicion->idCliente = $cliente->id;
            $medicion->estado = 0;
            $medicion->save();

            $notificacion = new FirebaseNotificacion;
            $notificacion->enviarNotificacion('🔊 Nueva asignación de medición','Asignación nro. '.$medicion->id,$colaborador->tokenFirebase,1,$medicion->id);

            if($indexColaboradores==$indexMaxColaboradores){
                $indexColaboradores=0;
            }else{
                $indexColaboradores++;
            }
        }


        return true;
    }


    public static function updateMedicion($request)
    {
        $medicion = Medicion::findOrFail($request->input('id'));
        if($medicion->estado==1){
            throw new \ErrorException('No puede reasignar esta medicion que ya fue lecturada');
        }
        $medicion->idColaborador = $request->input('idColaborador');
        $medicion->update();

        $colaborador = Colaborador::findOrFail($request->input('idColaborador'));
        $notificacion = new FirebaseNotificacion;
        $notificacion->enviarNotificacion('🔊 Reasignación de medición','Asignación nro. '.$medicion->id,$colaborador->tokenFirebase,1,$medicion->id);
        return $medicion;
    }


    //WEB SEVICES

    public static function listarAsignacionesPorIdColaboradorYEstado($idColaborador,$estado)
    {
        return Medicion::with('cliente')->with('mensualidad')->where('idColaborador',$idColaborador)->where('estado',$estado)->get();
    }

    public static function obtenerMedicionPorId($idMedicion)
    {
        return Medicion::with('cliente')->with('mensualidad')->where('id',$idMedicion)->first();
    }

    public static function obtenerUltimaMedicionPorIdCliente($idCliente)
    {
        return Medicion::where('idCliente',$idCliente)->where('estado',1)->whereNotNull('consumo')->orderBy('id','desc')->first();
    }

}

