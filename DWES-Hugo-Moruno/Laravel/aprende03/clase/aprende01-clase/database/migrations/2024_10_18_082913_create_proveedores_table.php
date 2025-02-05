<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProveedoresTable extends Migration
{
    public function up()
    {
       
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id(); 
            $table->string('nif', 15)->unique();
            $table->string('nombre', 15)->nullable();
            $table->string('apellido1', 15)->nullable();
            $table->string('apellido2', 15)->nullable();
            $table->boolean('autonomo');
            $table->string('razon_social',200)->nullable();
            $table->string('direccion', 200);
            $table->string('tlf', 15);
            $table->string('observaciones') ->nullable();
            $table->timestamps(); 
            $table->unique(['nif','nombre','apellido1','apellido2']);
        });
    }
    public function down(): void
    {
        Schema::table('articulos', function (Blueprint $table) {
            $table->dropForeign(['proveedor_id']);
            $table->dropColumn('proveedor_id');
        });
    
        Schema::dropIfExists('proveedores');
    }
    
}