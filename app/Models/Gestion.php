<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Auth;
use File;
use DB;


class Gestion extends Model
{
    protected $table='gestion';

    protected $primaryKey='id';

    public $timestamps=true;


    protected $fillable =[
		'nombre',
        'eliminado' 
    ];

    protected $guarded =[

    ];


    //SCOPES
    public function scope_getGestiones($query)
    {
        return $query->orderBy('id','desc')->where('eliminado',0)->paginate(10);
    }

    public function scope_getTodasGestiones($query)
    {
        return $query->orderBy('id','desc')->where('eliminado',0)->get();
    }


    public function scope_searchGestiones($query,$request)
    {
        return $query->where($request->input('parametro'), 'LIKE','%'.$request->input('valor').'%')->where('eliminado',0)->orderBy('id','desc')->paginate(10);
    }

    //RELATIONSHIPS
    public function mensualidades()
    {
        return $this->hasMany('App\Models\Mensualidad','idMensualidad','id')->where('eliminado',0);
    }

   
    //STATICS
    public static function createGestion($request)
    {
        $gestion = new Gestion;
        $gestion->nombre = $request->input('nombre'); 
        $gestion->eliminado = 0;
        $gestion->save();
        return $gestion;
    }


    public static function updateGestion($request)
    {
        $gestion = Gestion::findOrFail($request->input('id'));
        $gestion->nombre = $request->input('nombre');
        $gestion->update();
        return $gestion;
    }


    public static function deleteGestion($request)
    {
        $gestion = Gestion::findOrFail($request->input('id'));
        $gestion->eliminado = 1;
        $gestion->update();
        return $gestion;
    }

}
