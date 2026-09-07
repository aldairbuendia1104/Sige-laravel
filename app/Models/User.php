<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'telefono',
        'curp',
        'fecha_nacimiento',
        'sexo',
        'identificacion',
        'activo',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'fecha_nacimiento' => 'date',
            'ultimo_acceso' => 'datetime',
            'activo' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'rol_user');
    }

    public function maestro()
    {
        return $this->hasOne(Maestro::class);
    }

    public function administrativo()
    {
        return $this->hasOne(Administrativo::class);
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class);
    }

    public function alumno()
    {
        return $this->hasOne(Alumno::class);
    }

    public function tieneRol(string $rol): bool
    {
        return $this->roles()
            ->where('nombre', $rol)
            ->exists();
    }

    public function nombreCompleto(): string
    {
        return trim(
            $this->nombre . ' ' .
            $this->apellido_paterno . ' ' .
            $this->apellido_materno
        );
    }
}