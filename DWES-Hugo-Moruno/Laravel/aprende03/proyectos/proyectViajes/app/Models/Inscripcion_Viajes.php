<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inscripcion_Viajes extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inscripcion_viajes';

    protected $fillable = [
        'viaje_id',
        'cliente_id',
        'dto',
    ];

    // Relaciones
    public function viaje()
    {
        return $this->belongsTo(Viaje::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
