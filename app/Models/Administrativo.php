<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numero_empleado',
        'puesto',
        'departamento',
        'extension',
        'fecha_ingreso',
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