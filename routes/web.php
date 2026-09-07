<?php

use App\Http\Controllers\GradoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | MÓDULOS EXCLUSIVOS DEL DIRECTOR
    |--------------------------------------------------------------------------
    */

    Route::middleware('director')->group(function () {

        // Administración de grados
        Route::resource('grados', GradoController::class);

        // Administración de usuarios
        Route::resource('usuarios', UsuarioController::class);

        // Regenerar contraseña
        Route::post(
            '/usuarios/{usuario}/regenerar-password',
            [UsuarioController::class, 'regenerarPassword']
        )->name('usuarios.regenerar-password');

    });


    /*
    |--------------------------------------------------------------------------
    | PERFIL DEL USUARIO
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


require __DIR__.'/auth.php';