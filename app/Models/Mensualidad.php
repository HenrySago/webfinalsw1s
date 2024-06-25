<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Auth;
use File;
use DB;


class Mensualidad extends Model
{
    protected $table='mensualidad';

    protected $primaryKey='id';

    public $timestamps=true;


    protected $fillable =[
		'nombre',
        'idGestion',
        'eliminado' 
    ];

    protected $guarded =[

    ];


    //SCOPES
    public function scope_getMensualidades($query)
    {
        return $query->orderBy('id','asc')->where('eliminado',0)->paginate(10);
    }

    public function scope_getTodosMensualidades($query)
    {
        return $query->orderBy('id','asc')->where('eliminado',0)->get();
    }


    public function scope_searchMensualidades($query,$request)
    {
        return $query->where($request->input('parametro'), 'LIKE','%'.$request->input('valor').'%')->where('eliminado',0)->orderBy('id','desc')->paginate(10);
    }

    //RELATIONSHIPS
    public function gestion()
    {
        return $this->belongsTo('App\Models\Gestion','idGestion','id');
    }
    public function mediciones()
    {
        return $this->hasMany('App\Models\Medicion','idMensualidad','id');
    }

    //STATICS
    public static function getTotalMensualidades()
    {
        return Mensualidad::join('gestion','gestion.id','mensualidad.idGestion')
        ->join('medicion','medicion.idMensualidad','mensualidad.id')->select("mensualidad.nombre as nombreMensualidad","gestion.nombre as nombreGestion", DB::raw('SUM(medicion.total) as total') )->groupBy('mensualidad.nombre','gestion.nombre')->get();
    }

    public static function createMensualidad($request)
    {
        $mensualidad = new Mensualidad;
        $mensualidad->nombre = $request->input('nombre'); 
        $mensualidad->idGestion = $request->input('idGestion'); 
        $mensualidad->eliminado = 0;
        $mensualidad->save();
        return $mensualidad;
    }


    public static function updateMensualidad($request)
    {
        $mensualidad = Mensualidad::findOrFail($request->input('id'));
        $mensualidad->nombre = $request->input('nombre');
        $mensualidad->idGestion = $request->input('idGestion'); 
        $mensualidad->update();
        return $mensualidad;
    }


    public static function deleteMensualidad($request)
    {
        $mensualidad = Mensualidad::findOrFail($request->input('id'));
        $mensualidad->eliminado = 1;
        $mensualidad->update();
        return $mensualidad;
    }

}
