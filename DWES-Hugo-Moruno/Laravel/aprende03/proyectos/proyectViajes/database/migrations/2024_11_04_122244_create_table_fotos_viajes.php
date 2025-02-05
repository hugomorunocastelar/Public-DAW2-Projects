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
        Schema::create('fotos_viajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('viaje_id')
                ->constrained('viajes')
                ->cascadeOnDelete();
            $table->string('fichero', 200);
            $table->string('titulo', 200)->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos_viajes');
    }
};
