<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grados')->updateOrInsert(
            ['orden' => 1],
            [
                'nombre' => '1°',
                'descripcion' => 'Primer grado'
            ]
        );

        DB::table('grados')->updateOrInsert(
            ['orden' => 2],
            [
                'nombre' => '2°',
                'descripcion' => 'Segundo grado'
            ]
        );

        DB::table('grados')->updateOrInsert(
            ['orden' => 3],
            [
                'nombre' => '3°',
                'descripcion' => 'Tercer grado'
            ]
        );
    }
}