<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiclosEscolaresSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ciclos_escolares')->updateOrInsert(
            ['nombre' => '2026-2027'],
            [
                'fecha_inicio' => '2026-08-24',
                'fecha_fin' => '2027-07-16',
                'estatus' => 'Activo',
                'descripcion' => 'Primer ciclo escolar de SIGE',
            ]
        );
    }
}