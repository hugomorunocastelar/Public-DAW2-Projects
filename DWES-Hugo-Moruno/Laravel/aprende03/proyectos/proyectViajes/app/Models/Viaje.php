<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Viaje extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'viajes';

    protected $fillable = [
        'referencia',
        'titulo',
        'slug',
        'precio',
        'participantes',
        'salida',
        'llegada',
        'foto',
        'descripcion',
        'activo',
    ];
}
