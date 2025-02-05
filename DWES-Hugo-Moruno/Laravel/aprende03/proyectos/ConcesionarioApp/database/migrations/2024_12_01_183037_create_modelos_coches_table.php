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
        Schema::create('modelos_coches', function (Blueprint $table) {
            $table->id();
            $table->string('identificador');
            $table->string('nombre');
            $table->string('tipo')->nullable();
            $table->integer('anho');
            $table->unsignedBigInteger('marca_id')->nullable();
            $table->string('imagen')->nullable();
            $table->integer('descontinuado')->nullable();
            $table->timestamps();

            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelos_coches');
    }
};
