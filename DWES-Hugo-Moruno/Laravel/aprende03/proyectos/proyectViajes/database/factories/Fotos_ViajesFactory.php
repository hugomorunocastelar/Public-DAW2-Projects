<?php

namespace Database\Factories;

use App\Models\Fotos_Viajes;
use App\Models\Viaje;
use Illuminate\Database\Eloquent\Factories\Factory;

class Fotos_ViajesFactory extends Factory
{
    protected $model = Fotos_Viajes::class;

    public function definition()
    {
        return [
            'viaje_id' => Viaje::factory(),
            'fichero' => $this->faker->imageUrl(),
            'titulo' => $this->faker->sentence,
            'observaciones' => $this->faker->paragraph(),
        ];
    }
}
