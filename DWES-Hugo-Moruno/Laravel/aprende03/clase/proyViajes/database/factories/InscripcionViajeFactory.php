<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InscripcionViaje>
 */
class InscripcionViajeFactory extends Factory
{
    protected $model = \App\Models\InscripcionViaje::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'viaje_id' => \App\Models\Viaje::factory(),
            'cliente_id' => \App\Models\Cliente::factory(),
            'dto' => $this->faker->randomFloat(2, 0, 50),
        ];
    }
}
