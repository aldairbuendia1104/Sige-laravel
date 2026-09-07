<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('grupos', function (Blueprint $table) {
        $table->id();

        $table->foreignId('grado_id')->constrained('grados');

        $table->foreignId('ciclo_escolar_id')->constrained('ciclos_escolares');

        $table->string('nombre', 5);

        $table->integer('capacidad')->default(35);

        $table->text('descripcion')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
