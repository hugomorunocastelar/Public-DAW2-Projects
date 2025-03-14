<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion'
    ];

    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }
}
