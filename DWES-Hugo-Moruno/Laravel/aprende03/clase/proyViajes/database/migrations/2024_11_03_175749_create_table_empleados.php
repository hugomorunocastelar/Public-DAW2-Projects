<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nif', 12)->unique();
            $table->string('nombre', 20);
            $table->string('apellido1', 20);
            $table->string('apellido2', 20)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('foto', 200)->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
