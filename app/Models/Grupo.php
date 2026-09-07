<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'grado_id',
        'ciclo_escolar_id',
        'nombre',
        'capacidad',
        'descripcion',
    ];

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function cicloEscolar()
    {
        return $this->belongsTo(CicloEscolar::class);
    }
}