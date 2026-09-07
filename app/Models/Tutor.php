<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ocupacion',
        'parentesco_principal',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}