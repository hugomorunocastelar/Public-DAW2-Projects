<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'pais_origen',
        'imagen'
    ];

    public function modelos()
    {
        return $this->hasMany(ModelosCoche::class);
    }
}
