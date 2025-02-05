<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Inscripcion_Viajes;
use App\Models\Viaje;
use Illuminate\Database\Eloquent\Factories\Factory;

class Inscripcion_ViajesFactory extends Factory
{
    protected $model = Inscripcion_Viajes::class;

    public function definition()
    {
        return [
            'viaje_id' => Viaje::factory(),
            'cliente_id' => Cliente::factory(),
            'dto' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
