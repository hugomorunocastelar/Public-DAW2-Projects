<?php

namespace Database\Factories;

use App\Models\Viaje;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViajeFactory extends Factory
{
    protected $model = Viaje::class;

    public function definition()
    {
        return [
            'referencia' => $this->faker->unique()->word,
            'titulo' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'precio' => $this->faker->randomFloat(2, 100, 1000),
            'participantes' => $this->faker->numberBetween(1, 100),
            'salida' => $this->faker->dateTime,
            'llegada' => $this->faker->dateTime,
            'foto' => $this->faker->imageUrl(),
            'descripcion' => $this->faker->paragraph(),
            'activo' => $this->faker->boolean(),
        ];
    }
}
