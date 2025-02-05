<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    use HasFactory;

    protected $fillable = [
        'color',
        'matricula',
        'cliente_id',
        'modelo_coche_id',
        'vendido',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function modeloCoche()
    {
        return $this->belongsTo(ModelosCoche::class);
    }
}
