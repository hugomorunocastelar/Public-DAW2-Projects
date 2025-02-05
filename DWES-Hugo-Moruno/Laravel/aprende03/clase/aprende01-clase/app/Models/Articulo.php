<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Articulo extends Model
{
    use HasFactory;
    protected $table = 'articulos';
    protected $fillable = ['ref','descripcion','precio','observarciones'];
    
    public function proveedor() : BelongsTo   
    {
        return $this->belongsTo(Proveedor::class);
    }
}