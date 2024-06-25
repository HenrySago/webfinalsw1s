<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Mail\RecuperarPasswordClienteMail;
use Auth;
use File;
use DB;
use Mail;

class Emergencia extends Model
{
    protected $table='emergencia';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $hidden = [
    ];

    protected $fillable =[
		'id',
        'nombre',
        'descripcion',
		'id_tec',	
		'id_cli',	
		'id_zon'
    ];

    protected $guarded =[

    ];


    //SCOPES
    public function scope_getClientePorEmail($query,$email)
    {
    	return $query->where('email',$email)->where('eliminado',0)->first();
    }


    public function scope_getEmergencia($query)
    {
        return $query->select('emergencia.id', 'emergencia.nombre', 'emergencia.descripcion','colaborador.nombres as tecnico', 'cliente.nombres as cliente','ciudad.nombre as zona')->
        join('cliente', 'cliente.id', '=', 'emergencia.id_cli')->
        join('ciudad' , 'ciudad.id' , '=' , 'emergencia.id_zon')->
        join('colaborador' , 'colaborador.id' , '=' ,  'emergencia.id_tec')->
        paginate(10);
    }

    public function scope_getTodosEmergencia($query)
    {
        return $query->orderBy('id','desc')->where('eliminado',0)->get();
    }

    public function scope_getEmergenciaPorCiudad($query,$idCiudad)
    {
        return $query->orderBy('id','desc')->where('eliminado',0)->where('idCiudad',$idCiudad)->get();
    }



    public function scope_searchEmergencia($query,$request)
    {
        return $query->where($request->input('parametro'), 'LIKE','%'.$request->input('valor').'%')->where('eliminado',0)->orderBy('id','desc')->paginate(10);
    }

    //RELATIONSHIPS
    public function ciudad()
    {
        return $this->belongsTo('App\Models\Ciudad','idCiudad','id');
    }
    public function mediciones()
    {
        return $this->hasMany('App\Models\Medicion','idMedicion','id');
    }
    
    //STATICS
    public static function getNumeroClientes()
    {
        return Cliente::get()->count();
    }


    public static function verificarClienteHabilitadoPorEmail($email)
    {
       	$cliente = Cliente::_getClientePorEmail($email);
       	if ($cliente->inhabilitado==0) {
       		return true;
       	}else{
       		return false;
       	}
    }
    

    public static function createEmergencia($request)
    {
        $emergencia = new Emergencia;
        $emergencia->nombre = $request->input('nombre'); 
        $emergencia->descripcion = $request->input('descripcion'); 
        $emergencia->id_tec = $request->input('id_tec'); 
        $emergencia->id_zon = $request->input('id_zon'); 
        $emergencia->id_cli = 2 ; 
        $emergencia->save();
        return $emergencia;
    }

    public static function createDirectorioPorIdCliente($idcliente)
    {
        $destinationPath = public_path().'/clientes/'.$idcliente;
        File::makeDirectory($destinationPath, $mode = 0777, true, true); 
        return $destinationPath;
    }


    public static function actualizarPerfilPorIdCliente($request,$idcliente,$destinationPath)
    {
        if ($request->file('perfil')) {
            $file = $request->file('perfil');
            $cliente = Cliente::findOrFail($idcliente);
            $cliente->perfil = '/clientes/'.$idcliente.'/'.'img_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $cliente->perfil);
            $cliente->update(); 
            return $cliente;
        }
    }


    public static function updateEstado($request)
    {
        $cliente = Cliente::findOrFail($request->input('id'));
        if ($cliente->inhabilitado==1) {
            $cliente->inhabilitado = 0;
        }else{
            $cliente->inhabilitado = 1;
        }
        $cliente->update();
        return $cliente;
    }


    public static function updateCliente($request)
    {
        $cliente = Cliente::findOrFail($request->input('id'));
        $cliente->nombres = $request->input('nombres');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->celular = $request->input('celular');
        $cliente->direccion = $request->input('direccion'); 
        $cliente->referencia = $request->input('referencia'); 
        $cliente->latitud = $request->input('latitud'); 
        $cliente->longitud = $request->input('longitud'); 
        $cliente->idCiudad = $request->input('idCiudad');
        $cliente->email = $request->input('email');
        $cliente->ci = $request->input('ci');
        $cliente->nit = $request->input('nit');
        $cliente->nombreFactura = $request->input('nombreFactura');
        if ($request->input('password')) {
            $cliente->password =  Hash::make($request->input('password'));
        }
        $cliente->update();
        return $cliente;
    }


    public static function verificarEmailExiste($request)
    {
        $emails = DB::table('cliente')->where('email',$request->input('email'))->get();
        if (count($emails)>0) {
            return true;
        }else{
            return false;
        }
    }

    public static function verificarEmailExisteMenosClienteAEditar($request)
    {
        $emails = DB::table('cliente')->where('email',$request->input('email'))->where('cliente.id','<>',$request->input('id'))->get();
        if (count($emails)>0) {
            return true;
        }else{
            return false;
        }
    }


    public static function deleteCliente($request)
    {
        $cliente = Cliente::findOrFail($request->input('id'));
        $cliente->eliminado = 1;
        $cliente->update();
        return $cliente;
    }



    //WEB SERVICES


    public static function login($correo,$password)
    {
        $cliente = Cliente::where('email',$correo)->where('password',$password)->where('inhabilitado',0)->first();
        return $cliente;
    }

    public static function verificarSiExisteClientePorId($idCliente)
    {
        $cliente = Cliente::where('id',$idCliente)->first();
        return $cliente!=null?true:false;
    }

    public static function registrarDispositivo($idCliente,$tokenFirebase)
    {
        $cliente = Cliente::findOrFail($idCliente);
        $cliente->tokenFirebase = $tokenFirebase;
        $cliente->update();
        return $cliente;
    }

    public static function obtenerClientePorCorreo($correo)
    {
        $cliente = Cliente::where('email',$correo)->where('inhabilitado',0)->first();
        return $cliente;
    }


    public static function enviarCodigoRecuperacionPasswordPorIdCliente($idCliente)
    {
        $cliente = Cliente::findOrFail($idCliente);
        $cliente->codigoRecuperacion = mt_rand(1111,9999);
        $cliente->update();

        Mail::to($cliente->email)->send(new RecuperarPasswordClienteMail($cliente));

        return $cliente;
    }

    public static function obtenerClientePorCorreoYCodigo($correo,$codigo)
    {
        $cliente = Cliente::where('email',$correo)->where('codigoRecuperacion',$codigo)->where('inhabilitado',0)->first();
        return $cliente;
    }

    public static function borrarCodigoRecuperacionPasswordPorIdCliente($idCliente)
    {
        $cliente = Cliente::findOrFail($idCliente);
        $cliente->codigoRecuperacion = null;
        $cliente->update();

        return $cliente;
    }

    public static function cambiarPasswordPorIdCliente($idCliente,$password)
    {
        $cliente = Cliente::findOrFail($idCliente);
        $cliente->password = $password;
        $cliente->update();

        return $cliente;
    }

    public static function actualizarDatos($idCliente,$nombres,$apellidos,$nit,$nombreFactura,$perfil)
    {
        $cliente = Cliente::findOrFail($idCliente);
        $cliente->nombres = $nombres;
        $cliente->apellidos = $apellidos;
        $cliente->nit = $nit;
        $cliente->nombreFactura = $nombreFactura;
        if ($perfil) {
            $destinationPath = public_path().'/clientes/'.$idCliente;
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
            $file = $perfil;
            $cliente->perfil = '/clientes/'.$idCliente.'/'.'img_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $cliente->perfil);
        }
        $cliente->update();
        return $cliente;
    }




}
