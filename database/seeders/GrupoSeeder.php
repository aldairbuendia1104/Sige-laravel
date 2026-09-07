<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoSeeder extends Seeder
{
    public function run(): void
    {
        $grupos = [
            ['grado_id' => 1, 'ciclo_escolar_id' => 1, 'nombre' => 'A'],
            ['grado_id' => 1, 'ciclo_escolar_id' => 1, 'nombre' => 'B'],

            ['grado_id' => 2, 'ciclo_escolar_id' => 1, 'nombre' => 'A'],
            ['grado_id' => 2, 'ciclo_escolar_id' => 1, 'nombre' => 'B'],

            ['grado_id' => 3, 'ciclo_escolar_id' => 1, 'nombre' => 'A'],
            ['grado_id' => 3, 'ciclo_escolar_id' => 1, 'nombre' => 'B'],
        ];

        foreach ($grupos as $grupo) {
            DB::table('grupos')->updateOrInsert(
                [
                    'grado_id' => $grupo['grado_id'],
                    'ciclo_escolar_id' => $grupo['ciclo_escolar_id'],
                    'nombre' => $grupo['nombre'],
                ],
                [
                    'capacidad' => 35,
                    'descripcion' => null,
                ]
            );
        }
    }
}