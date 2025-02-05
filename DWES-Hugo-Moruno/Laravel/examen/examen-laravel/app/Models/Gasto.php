<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    protected $fillable = [
        'conceptos_id',
        'user_id',
        'gasto',
        'imagen',
        'fecha'
    ];

    public function concepto()
    {
        return $this->belongsTo(Concepto::class);
    }
}
