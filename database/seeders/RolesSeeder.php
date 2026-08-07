<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
    [
        'nombre' => 'Director',
        'descripcion' => 'Acceso total al sistema'
    ],
    [
        'nombre' => 'Administrativo',
        'descripcion' => 'Gestiona la información escolar'
    ],
    [
        'nombre' => 'Maestro',
        'descripcion' => 'Captura asistencias y calificaciones'
    ],
    [
        'nombre' => 'Alumno',
        'descripcion' => 'Consulta información académica'
    ],
    [
        'nombre' => 'Tutor',
        'descripcion' => 'Consulta información de sus hijos'
    ]
]);
    }
}
