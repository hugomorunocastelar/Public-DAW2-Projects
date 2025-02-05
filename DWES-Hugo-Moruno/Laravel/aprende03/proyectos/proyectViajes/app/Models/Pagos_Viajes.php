<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagos_Viajes extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pagos_viajes';

    protected $fillable = [
        'inscripcion_viaje_id',
        'pago',
    ];

    // Relación con InscripcionViaje
    public function inscripcionViaje()
    {
        return $this->belongsTo(Inscripcion_Viajes::class);
    }
}
