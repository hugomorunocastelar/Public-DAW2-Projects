<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'empleados';

    protected $fillable = [
        'nif',
        'nombre',
        'apellido1',
        'apellido2',
        'fecha_nacimiento',
        'foto',
        'observaciones',
        'active',
    ];
}
