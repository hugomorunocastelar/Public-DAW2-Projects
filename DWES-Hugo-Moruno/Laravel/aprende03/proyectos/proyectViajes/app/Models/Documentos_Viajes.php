<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documentos_Viajes extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'documentos_viajes';

    protected $fillable = [
        'viaje_id',
        'fichero',
        'titulo',
        'observaciones',
    ];

    // Relación con Viaje
    public function viaje()
    {
        return $this->belongsTo(Viaje::class);
    }
}
