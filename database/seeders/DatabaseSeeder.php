<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            CiclosEscolaresSeeder::class,
            GradoSeeder::class,
            GrupoSeeder::class,
            DirectorSeeder::class,
        ]);
    }
}