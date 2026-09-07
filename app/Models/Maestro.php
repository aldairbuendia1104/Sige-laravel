<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numero_empleado',
        'especialidad',
        'cedula_profesional',
        'fecha_ingreso',
        'tipo_contratacion',
    ];

    protected function casts(): array
    {
        return [
            'fecha_ingreso' => 'date',
        ];
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}