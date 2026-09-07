<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('telefono', 20)
                ->nullable()
                ->after('email');

            $table->string('curp', 18)
                ->nullable()
                ->unique()
                ->after('telefono');

            $table->date('fecha_nacimiento')
                ->nullable()
                ->after('curp');

            $table->enum('sexo', ['Masculino', 'Femenino', 'Otro'])
                ->nullable()
                ->after('fecha_nacimiento');

            $table->string('identificacion', 30)
                ->nullable()
                ->unique()
                ->after('sexo');

            $table->boolean('activo')
                ->default(true)
                ->after('identificacion');

            $table->timestamp('ultimo_acceso')
                ->nullable()
                ->after('activo');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['curp']);
            $table->dropUnique(['identificacion']);

            $table->dropColumn([
                'telefono',
                'curp',
                'fecha_nacimiento',
                'sexo',
                'identificacion',
                'activo',
                'ultimo_acceso',
            ]);
        });
    }
};