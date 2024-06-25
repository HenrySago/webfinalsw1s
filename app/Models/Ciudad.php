<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Medicion;
use File;
use DB;

class Ciudad extends Model
{
    protected $table='ciudad';

    protected $primaryKey='id';

    public $timestamps=true;


    protected $fillable =[
		'nombre',
        'tarifa',
		'bandera',
		'eliminado'
    ];

    protected $guarded =[

    ];


    //SCOPES
    public function scope_getCiudades($query)
    {
    	return $query->where('eliminado',0)->get();
    }

    public function scope_getCiudadPorId($query,$idciudad)
    {
        return $query->where('eliminado',0)->where('id',$idciudad)->get();
    }


    //RELATIONSHIPS
    public function clientes()
    {
        return $this->hasMany('App\Models\Cliente','idCiudad','id')->where('eliminado',0);
    }

    public function colaboradores()
    {
        return $this->hasMany('App\Models\Colaborador','idCiudad','id')->where('eliminado',0);
    }

    //STATICS
    public static function createCiudad($request)
    {
        $ciudad = new Ciudad;
        $ciudad->nombre = $request->input('nombre');
        $ciudad->tarifa = $request->input('tarifa');
        $ciudad->digitosEnterosMedidor = $request->input('digitosEnterosMedidor');
        $ciudad->digitosDecimalesMedidor = $request->input('digitosDecimalesMedidor');
        $ciudad->eliminado = 0;
        $ciudad->save();
        return $ciudad;
    }


    public static function updateCiudad($request)
    {
        $ciudad = Ciudad::findOrFail($request->input('id'));
        $ciudad->nombre = $request->input('nombre');
        $ciudad->tarifa = $request->input('tarifa');
        $ciudad->digitosEnterosMedidor = $request->input('digitosEnterosMedidor');
        $ciudad->digitosDecimalesMedidor = $request->input('digitosDecimalesMedidor');
        $ciudad->update();
        return $ciudad;
    }

    
    public static function deleteCiudad($request)
    {
        $ciudad = Ciudad::findOrFail($request->input('id'));
        $ciudad->eliminado = 1;
        $ciudad->update();
        return $ciudad;
    }

    public static function createDirectorioPorIdCiudad($idciudad)
    {
        $destinationPath = public_path().'/ciudades/'.$idciudad.'/bandera/';
        File::makeDirectory($destinationPath, $mode = 0777, true, true); 
        return $destinationPath;
    }



    public static function updateBanderaPorIdCiudad($request,$idciudad,$destinationPath)
    {
        if ($request->file('bandera')) {
            $file = $request->file('bandera');
            $ciudad = Ciudad::findOrFail($idciudad);
            $ciudad->bandera = '/ciudades/'.$idciudad.'/bandera/'.'bandera_'.uniqid().'.'.$file->getClientOriginalExtension();
            $ciudad->update();
            $file->move($destinationPath, $ciudad->bandera);
        }
    }

    //WEB SERVICES
    public static function obtenerPrecioPorIdCiudadIdClienteYConsumo($idCiudad,$idCliente,$consumo)
    {
        $ciudad = Ciudad::findOrFail($idCiudad);
        $cliente = Cliente::findOrFail($idCliente);
        $digitosEnterosMedidor = $ciudad->digitosEnterosMedidor;
        $digitosDecimalesMedidor = $ciudad->digitosDecimalesMedidor;
        $consumo = substr($consumo,0,$digitosEnterosMedidor);
        $ultimaMedicion = Medicion::obtenerUltimaMedicionPorIdCliente($idCliente);
        $consumoReal = 0;
        $consumoAnterior = 0;
        if($ultimaMedicion){
            $consumoReal = ((int)$consumo) - $ultimaMedicion->consumo;
            $consumoAnterior = $ultimaMedicion->consumo;
        }else{
            $consumoReal = ((int)$consumo) - 0;
            $consumoAnterior = 0;
        }
        if($consumoReal<=0){
            throw new \ErrorException('La lectura del consumo anterior es: '.$consumoAnterior.' y la actual es: '.(int)$consumo.' por favor lecture nuevamente.');
        }

        $costo = round(($ciudad->tarifa * $consumoReal), 2);
        return ['consumoAnterior'=>$consumoAnterior,'consumo'=>(int)$consumo,'consumoReal'=>$consumoReal,'tarifa'=>$ciudad->tarifa,'costo'=>$costo];
    }



}
