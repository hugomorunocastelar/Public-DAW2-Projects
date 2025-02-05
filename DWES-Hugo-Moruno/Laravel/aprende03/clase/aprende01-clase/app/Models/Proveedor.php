<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedores';

    protected $fillable = ['nif','nombre','razon_social','direccion','tlf'];
    public function articulos() : HasMany {
        return $this -> hasMany(Articulo::class);
    }
}
