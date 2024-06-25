<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cliente')->insert(
        [
            [
            'nombres' => 'Nanet',
            'apellidos'=> 'Taboada Frias',
            'perfil' => '/clientes/1/1.png',
            'ci' => '236326',
            'email' => 'nanet7777@gmail.com',    
            'celular' => '68836930',
            'password' =>'111',   
            'idCiudad' => 1,
            'eliminado' => 0,
            'inhabilitado' => 0,
            'latitud' => '-17.808574',
            'longitud' => '-63.180710',
            'nit' => '75643634',
            'nombreFactura' => 'Nanet Taboada',
            'direccion' => '5to anillo radial 13 nro 8',
            'referencia' => 'Puerta de madera color cafe',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'nombres' => 'Ronald',
            'apellidos'=> 'Lopez Orellana',
            'perfil' => '/clientes/1/1.png',
            'ci' => '235325',
            'email' => 'cronald@gmail.com',    
            'celular' => '68836930',
            'password' =>'222',   
            'idCiudad' => 1,
            'eliminado' => 0,
            'inhabilitado' => 0,
            'latitud' => '-17.808574',
            'longitud' => '-63.180710',
            'nit' => '75643634',
            'nombreFactura' => 'Nanet Taboada',
            'direccion' => '5to anillo radial 13 nro 8',
            'referencia' => 'Puerta de madera color cafe',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'nombres' => 'Andres',
            'apellidos'=> 'Contreras Ojeda',
            'perfil' => '/clientes/1/1.png',
            'ci' => '735643',
            'email' => 'candres@gmail.com',   
            'celular' => '68836930',
            'password' =>'333',   
            'idCiudad' => 1,
            'eliminado' => 0,
            'inhabilitado' => 0,
            'latitud' => '-17.808574',
            'longitud' => '-63.180710',
            'nit' => '75643634',
            'nombreFactura' => 'Nanet Taboada',
            'direccion' => '5to anillo radial 13 nro 8',
            'referencia' => 'Puerta de madera color cafe',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'nombres' => 'Yimmy',
            'apellidos'=> 'Quispe Yujra',
            'perfil' => '/clientes/1/1.png',
            'ci' => '845344',
            'email' => 'cyimmy@gmail.com',
            'celular' => '68836930',
            'password' =>'444',  
            'idCiudad' => 1,
            'eliminado' => 0,
            'inhabilitado' => 0,
            'latitud' => '-17.808574',
            'longitud' => '-63.180710',
            'nit' => '75643634',
            'nombreFactura' => 'Nanet Taboada',
            'direccion' => '5to anillo radial 13 nro 8',
            'referencia' => 'Puerta de madera color cafe',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'nombres' => 'Jorge',
            'apellidos'=> 'Ivan Gutierrez',
            'perfil' => '/clientes/1/1.png',
            'ci' => '6146041',
            'email' => 'ccocopaz90@gmail.com',
            'celular' => '68836930',
            'password' =>'elgatofelix',  
            'idCiudad' => 1,
            'eliminado' => 0,
            'inhabilitado' => 0,
            'latitud' => '-17.808574',
            'longitud' => '-63.180710',
            'nit' => '75643634',
            'nombreFactura' => 'Nanet Taboada',
            'direccion' => '5to anillo radial 13 nro 8',
            'referencia' => 'Puerta de madera color cafe',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'nombres' => 'Jose',
            'apellidos'=> 'Mendoza',
            'perfil' => '/clientes/1/1.png',
            'ci' => '8168623',
            'email' => 'cjoseivanguti.pay@gmail.com',
            'celular' => '68836930',
            'password' =>'mrdelivery2018',  
            'idCiudad' => 1,
            'eliminado' => 0,
            'inhabilitado' => 0,
            'latitud' => '-17.808574',
            'longitud' => '-63.180710',
            'nit' => '75643634',
            'nombreFactura' => 'Nanet Taboada',
            'direccion' => '5to anillo radial 13 nro 8',
            'referencia' => 'Puerta de madera color cafe',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        ]);
    }
}
