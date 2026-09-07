<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;

class DirectorSeeder extends Seeder
{
    public function run(): void
    {
        $rolDirector = Rol::where('nombre', 'Director')->first();

        if (!$rolDirector) {
            throw new \Exception('El rol Director no existe.');
        }

        $usuario = User::updateOrCreate(
            [
                'email' => 'directorprueba1@gmail.com'
            ],
            [
                'nombre' => 'Director',
                'apellido_paterno' => 'Prueba',
                'apellido_materno' => 'SIGE',
                'password' => Hash::make('12345678'),
                'activo' => true,
            ]
        );

        $usuario->roles()->syncWithoutDetaching([
            $rolDirector->id
        ]);
    }
}