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
    DB::table('roles')->updateOrInsert(
        ['nombre' => 'Director'],
        ['descripcion' => 'Acceso total al sistema']
    );

    DB::table('roles')->updateOrInsert(
        ['nombre' => 'Administrativo'],
        ['descripcion' => 'Gestiona la información escolar']
    );

    DB::table('roles')->updateOrInsert(
        ['nombre' => 'Maestro'],
        ['descripcion' => 'Captura asistencias y calificaciones']
    );

    DB::table('roles')->updateOrInsert(
        ['nombre' => 'Alumno'],
        ['descripcion' => 'Consulta información académica']
    );

    DB::table('roles')->updateOrInsert(
        ['nombre' => 'Tutor'],
        ['descripcion' => 'Consulta información de sus hijos']
    );
}
}
