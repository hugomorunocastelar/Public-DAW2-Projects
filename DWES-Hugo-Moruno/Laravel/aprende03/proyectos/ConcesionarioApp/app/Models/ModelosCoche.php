<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelosCoche extends Model
{
    use HasFactory;

    protected $fillable = [
        'identificador',
        'nombre',
        'tipo',
        'anho',
        'marca_id',
        'imagen',
        'descontinuado'
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function coches()
    {
        return $this->hasMany(Coche::class);
    }
}
