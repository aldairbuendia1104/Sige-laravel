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
    Schema::table('users', function (Blueprint $table) {
        $table->foreignId('rol_id')->after('id');
        $table->string('apellido_paterno')->after('name');
        $table->string('apellido_materno')->after('apellido_paterno');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'rol_id',
            'apellido_paterno',
            'apellido_materno'
        ]);
    });
}
};
