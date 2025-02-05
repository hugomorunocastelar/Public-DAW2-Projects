<?php

namespace Database\Factories;

use App\Models\Documentos_Viajes;
use App\Models\Viaje;
use Illuminate\Database\Eloquent\Factories\Factory;

class Documentos_ViajesFactory extends Factory
{
    protected $model = Documentos_Viajes::class;

    public function definition()
    {
        return [
            'viaje_id' => Viaje::factory(),
            'fichero' => $this->faker->word . '.pdf',
            'titulo' => $this->faker->sentence,
            'observaciones' => $this->faker->paragraph(),
        ];
    }
}
