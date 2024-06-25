<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ciudad')->insert(
        [
            [
            'nombre' => 'Santa Cruz',
            'tarifa' => 1.5,
            'digitosEnterosMedidor' => 5,
            'digitosDecimalesMedidor' => 2,
            'bandera' => '/ciudades/1/bandera/bandera_62641cc147f1a.png',
            'eliminado' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        ]);
    }
}
