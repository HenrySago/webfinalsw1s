<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class GestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gestion')->insert(
        [
            [
            'nombre' => '2022',
            'eliminado' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ],
            [
            'nombre' => '2023',
            'eliminado' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
            ]
        ]);
    }
}
