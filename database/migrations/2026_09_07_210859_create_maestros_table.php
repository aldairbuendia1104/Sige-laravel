<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maestros', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('numero_empleado', 30)->unique();

            $table->string('especialidad', 150)->nullable();

            $table->string('cedula_profesional', 50)
                ->nullable()
                ->unique();

            $table->date('fecha_ingreso')->nullable();

            $table->string('tipo_contratacion', 100)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maestros');
    }
};