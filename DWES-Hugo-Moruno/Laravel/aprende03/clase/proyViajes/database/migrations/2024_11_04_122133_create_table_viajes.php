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
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->string('referencia', 15)->unique();
            $table->string('titulo', 200);
            $table->string('slug', 250);
            $table->decimal('precio', 8, 2)->nullable();
            $table->integer('participantes')->nullable();
            $table->dateTime('salida')->nullable();
            $table->dateTime('llegada')->nullable();
            $table->string('foto', 100)->nullable();
            $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('viajes');
    }
};
