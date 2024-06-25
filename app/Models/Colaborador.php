<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Mail\RecuperarPasswordColaboradorMail;
use Auth;
use File;
use DB;
use Mail;

class Colaborador extends Model
{
    protected $table='colaborador';

    protected $primaryKey='id';

    public $timestamps=true;

    protected $hidden = [
        'tokenFirebase',
        'codigoRecuperacion',
        'created_at',
        'updated_at'
    ];

    protected $fillable =[
		'nombres',
        'apellidos',
        'celular',
		'ci',	
		'email',	
		'password',	
        'idCiudad', 
        'eliminado', 
		'inhabilitado'
    ];

    protected $guarded =[

    ];


    //SCOPES
    public function scope_getColaboradorPorEmail($query,$email)
    {
    	return $query->where('email',$email)->where('eliminado',0)->first();
    }


    public function scope_getColaboradores($query)
    {
        return $query->orderBy('id','desc')->where('eliminado',0)->paginate(10);
    }

    public function scope_getTodosColaboradores($query)
    {
        return $query->orderBy('id','desc')->where('eliminado',0)->get();
    }

    public function scope_getColaboradoresPorCiudad($query,$idCiudad)
    {
        return $query->orderBy('id','desc')->where('eliminado',0)->where('idCiudad',$idCiudad)->get();
    }



    public function scope_searchColaboradores($query,$request)
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
        return $this->hasMany('App\Models\Medicion','idColaborador','id');
    }
     
    //STATICS
    public static function getNumeroColaboradores()
    {
        return Colaborador::get()->count();
    }

    public static function getColaboraresConMediciones()
    {
        return Colaborador::with('mediciones')->has('mediciones')->get();
    }

    public static function verificarColaboradorHabilitadoPorEmail($email)
    {
       	$colaborador = Colaborador::_getColaboradorPorEmail($email);
       	if ($colaborador->inhabilitado==0) {
       		return true;
       	}else{
       		return false;
       	}
    }
    

    public static function createColaborador($request)
    {
        $colaborador = new Colaborador;
        $colaborador->nombres = $request->input('nombres'); 
        $colaborador->apellidos = $request->input('apellidos'); 
        $colaborador->celular = $request->input('celular'); 
        $colaborador->idCiudad = $request->input('idCiudad'); 
        $colaborador->ci = $request->input('ci');
        $colaborador->email = $request->input('email');    
        $colaborador->password =  Hash::make($request->input('password'));
        $colaborador->inhabilitado = 0;
        $colaborador->eliminado = 0;
        $colaborador->save();
        return $colaborador;
    }

    public static function createDirectorioPorIdColaborador($idcolaborador)
    {
        $destinationPath = public_path().'/colaboradores/'.$idcolaborador;
        File::makeDirectory($destinationPath, $mode = 0777, true, true); 
        return $destinationPath;
    }


    public static function actualizarPerfilPorIdColaborador($request,$idcolaborador,$destinationPath)
    {
        if ($request->file('perfil')) {
            $file = $request->file('perfil');
            $colaborador = Colaborador::findOrFail($idcolaborador);
            $colaborador->perfil = '/colaboradores/'.$idcolaborador.'/'.'img_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $colaborador->perfil);
            $colaborador->update(); 
            return $colaborador;
        }
    }


    public static function updateEstado($request)
    {
        $colaborador = Colaborador::findOrFail($request->input('id'));
        if ($colaborador->inhabilitado==1) {
            $colaborador->inhabilitado = 0;
        }else{
            $colaborador->inhabilitado = 1;
        }
        $colaborador->update();
        return $colaborador;
    }


    public static function updateColaborador($request)
    {
        $colaborador = Colaborador::findOrFail($request->input('id'));
        $colaborador->nombres = $request->input('nombres');
        $colaborador->apellidos = $request->input('apellidos');
        $colaborador->celular = $request->input('celular');
        $colaborador->idCiudad = $request->input('idCiudad');
        $colaborador->email = $request->input('email');
        $colaborador->ci = $request->input('ci');
        if ($request->input('password')) {
            $colaborador->password =  Hash::make($request->input('password'));
        }
        $colaborador->update();
        return $colaborador;
    }


    public static function verificarEmailExiste($request)
    {
        $emails = DB::table('colaborador')->where('email',$request->input('email'))->get();
        if (count($emails)>0) {
            return true;
        }else{
            return false;
        }
    }

    public static function verificarEmailExisteMenosColaboradorAEditar($request)
    {
        $emails = DB::table('colaborador')->where('email',$request->input('email'))->where('colaborador.id','<>',$request->input('id'))->get();
        if (count($emails)>0) {
            return true;
        }else{
            return false;
        }
    }


    public static function deleteColaborador($request)
    {
        $colaborador = Colaborador::findOrFail($request->input('id'));
        $colaborador->eliminado = 1;
        $colaborador->update();
        return $colaborador;
    }

    //WEB SERVICES

    public static function login($correo,$password)
    {
        $colaborador = Colaborador::where('email',$correo)->where('password',$password)->where('inhabilitado',0)->first();
        return $colaborador;
    }

    public static function verificarSiExisteColaboradorPorId($idColaborador)
    {
        $colaborador = Colaborador::where('id',$idColaborador)->first();
        return $colaborador!=null?true:false;
    }

    public static function registrarDispositivo($idColaborador,$tokenFirebase)
    {
        $colaborador = Colaborador::findOrFail($idColaborador);
        $colaborador->tokenFirebase = $tokenFirebase;
        $colaborador->update();
        return $colaborador;
    }

    public static function obtenerColaboradorPorCorreo($correo)
    {
        $colaborador = Colaborador::where('email',$correo)->where('inhabilitado',0)->first();
        return $colaborador;
    }


    public static function enviarCodigoRecuperacionPasswordPorIdColaborador($idColaborador)
    {
        $colaborador = Colaborador::findOrFail($idColaborador);
        $colaborador->codigoRecuperacion = mt_rand(1111,9999);
        $colaborador->update();

        Mail::to($colaborador->email)->send(new RecuperarPasswordColaboradorMail($colaborador));

        return $colaborador;
    }

    public static function obtenerColaboradorPorCorreoYCodigo($correo,$codigo)
    {
        $colaborador = Colaborador::where('email',$correo)->where('codigoRecuperacion',$codigo)->where('inhabilitado',0)->first();
        return $colaborador;
    }

    public static function borrarCodigoRecuperacionPasswordPorIdColaborador($idColaborador)
    {
        $colaborador = Colaborador::findOrFail($idColaborador);
        $colaborador->codigoRecuperacion = null;
        $colaborador->update();

        return $colaborador;
    }

    public static function cambiarPasswordPorIdColaborador($idColaborador,$password)
    {
        $colaborador = Colaborador::findOrFail($idColaborador);
        $colaborador->password = $password;
        $colaborador->update();

        return $colaborador;
    }


    public static function actualizarDatos($idColaborador,$nombres,$apellidos,$perfil)
    {
        $colaborador = Colaborador::findOrFail($idColaborador);
        $colaborador->nombres = $nombres;
        $colaborador->apellidos = $apellidos;
        if ($perfil) {
            $destinationPath = public_path().'/colaboradores/'.$idColaborador;
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
            $file = $perfil;
            $colaborador->perfil = '/colaboradores/'.$idColaborador.'/'.'img_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $colaborador->perfil);
        }
        $colaborador->update();
        return $colaborador;
    }




}
