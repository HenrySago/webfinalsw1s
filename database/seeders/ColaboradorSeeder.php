<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ColaboradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colaborador')->insert(
        [
            [
            'nombres' => 'Nanet',
            'apellidos'=> 'Taboada Frias',
            'perfil' => '/colaboradores/1/1.png',
            'ci' => '236326',
            'email' => 'nanettaboadafriass@gmail.com',    
            'celular' => '68836930',
            'password' =>'111',   
            'idCiudad' => 1,
            'eliminado' => 0,
            'inhabilitado' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'nombres' => 'Ronald',
            'apellidos'=> 'Lopez Orellana',
            'perfil' => '/colaboradores/1/1.png',
            'ci' => '235325',
            'email' => 'ronald@gmail.com',    
            'celular' => '68836930',
            'password' =>'222',   
            'idCiudad' => 1,
            'eliminado' => 0,
            'inhabilitado' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'nombres' => 'Andres',
            'apellidos'=> 'Contreras Ojeda',
            'perfil' => '/colaboradores/1/1.png',
            'ci' => '735643',
            'email' => 'andres@gmail.com',   
            'celular' => '68836930',
            'password' =>'333',   
            'idCiudad' => 1,
            'eliminado' => 0,
            'inhabilitado' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'nombres' => 'Yimmy',
            'apellidos'=> 'Quispe Yujra',
            'perfil' => '/colaboradores/1/1.png',
            'ci' => '845344',
            'email' => 'yimmy@gmail.com',
            'celular' => '68836930',
            'password' =>'444',  
            'idCiudad' => 1,
            'eliminado' => 0,
            'inhabilitado' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'nombres' => 'Jorge',
            'apellidos'=> 'Ivan Gutierrez',
            'perfil' => '/colaboradores/1/1.png',
            'ci' => '6146041',
            'email' => 'cocopaz90@gmail.com',
            'celular' => '68836930',
            'password' =>'elgatofelix',  
            'idCiudad' => 1,
            'eliminado' => 0,
            'inhabilitado' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'nombres' => 'Jose',
            'apellidos'=> 'Mendoza',
            'perfil' => '/colaboradores/1/1.png',
            'ci' => '8168623',
            'email' => 'joseivanguti.pay@gmail.com',
            'celular' => '68836930',
            'password' =>'mrdelivery2018',  
            'idCiudad' => 1,
            'eliminado' => 0,
            'inhabilitado' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        ]);
    }
}
