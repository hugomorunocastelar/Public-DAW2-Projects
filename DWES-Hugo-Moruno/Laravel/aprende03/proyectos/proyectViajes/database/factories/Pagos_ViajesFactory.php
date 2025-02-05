<?php

namespace Database\Factories;

use App\Models\Inscripcion_Viajes;
use App\Models\Pagos_Viajes;
use Illuminate\Database\Eloquent\Factories\Factory;

class Pagos_ViajesFactory extends Factory
{
    protected $model = Pagos_Viajes::class;
    public function definition(): array
    {
        return [
            'inscripcion_viaje_id' => Inscripcion_Viajes::factory(),
            'pago' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
