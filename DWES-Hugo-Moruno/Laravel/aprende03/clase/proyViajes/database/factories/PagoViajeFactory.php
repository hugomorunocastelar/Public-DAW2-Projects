<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PagoViaje>
 */
class PagoViajeFactory extends Factory
{
    protected $model = \App\Models\PagoViaje::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inscripcion_viaje_id' => \App\Models\InscripcionViaje::factory(),
            'pago' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
