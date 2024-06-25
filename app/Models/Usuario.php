<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Auth;
use File;
use DB;


class Usuario extends Model
{
    protected $table='users';

    protected $primaryKey='id';

    public $timestamps=true;


    protected $fillable =[
		'name',
		'perfil',	
		'ci',	
		'email',	
		'password',	
		'inhabilitado',
        'eliminado' 
    ];

    protected $guarded =[

    ];


    //SCOPES
    public function scope_getUsuarioPorEmail($query,$email)
    {
    	return $query->where('email',$email)->where('eliminado',0)->first();
    }


    public function scope_getAdministradores($query)
    {
        return $query->orderBy('id','desc')->where('eliminado',0)->paginate(10);
    }

    public function scope_searchAdministradores($query,$request)
    {
        return $query->where($request->input('parametro'), 'LIKE','%'.$request->input('valor').'%')->where('eliminado',0)->orderBy('id','desc')->paginate(10);
    }

    //RELATIONSHIPS
    public function mediciones()
    {
        return $this->hasMany('App\Models\Medicion','idMedicion','id');
    }
   
    //STATICS
    public static function verificarAdministradorHabilitadoPorEmail($email)
    {
       	$usuario = Usuario::_getUsuarioPorEmail($email);
       	if ($usuario->inhabilitado==0) {
       		return true;
       	}else{
       		return false;
       	}
    }
    

    public static function createAdministrador($request)
    {
        $usuario = new Usuario;
        $usuario->name = $request->input('name'); 
        $usuario->ci = $request->input('ci');
        $usuario->email = $request->input('email');    
        $usuario->password =  Hash::make($request->input('password'));
        $usuario->inhabilitado = 0;
        $usuario->eliminado = 0;
        $usuario->save();
        return $usuario;
    }

    public static function createDirectorioPorIdAdministrador($idusuario)
    {
        $destinationPath = public_path().'/administradores/'.$idusuario;
        File::makeDirectory($destinationPath, $mode = 0777, true, true); 
        return $destinationPath;
    }


    public static function actualizarPerfilPorIdAdministrador($request,$idusuario,$destinationPath)
    {
        if ($request->file('perfil')) {
            $file = $request->file('perfil');
            $usuario = Usuario::findOrFail($idusuario);
            $usuario->perfil = '/administradores/'.$idusuario.'/'.'img_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $usuario->perfil);
            $usuario->update(); 
            return $usuario;
        }
    }


    public static function updateEstado($request)
    {
        $usuario = Usuario::findOrFail($request->input('id'));
        if ($usuario->inhabilitado==1) {
            $usuario->inhabilitado = 0;
        }else{
            $usuario->inhabilitado = 1;
        }
        $usuario->update();
        return $usuario;
    }


    public static function updateAdministrador($request)
    {
        $usuario = Usuario::findOrFail($request->input('id'));
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->ci = $request->input('ci');
        if ($request->input('password')) {
            $usuario->password =  Hash::make($request->input('password'));
        }
        $usuario->update();
        return $usuario;
    }



    public static function verificarEmailExiste($request)
    {
        $emails = DB::table('users')->where('email',$request->input('email'))->get();
        if (count($emails)>0) {
            return true;
        }else{
            return false;
        }
    }

    public static function verificarEmailExisteMenosAdministradorAEditar($request)
    {
        $emails = DB::table('users')->where('email',$request->input('email'))->where('users.id','<>',$request->input('id'))->get();
        if (count($emails)>0) {
            return true;
        }else{
            return false;
        }
    }


    public static function deleteAdministrador($request)
    {
        $usuario = Usuario::findOrFail($request->input('id'));
        $usuario->eliminado = 1;
        $usuario->update();
        return $usuario;
    }

}
