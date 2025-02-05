<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FotoViaje>
 */
class FotoViajeFactory extends Factory
{
    protected $model = \App\Models\FotoViaje::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'viaje_id' => \App\Models\Viaje::factory(),
            'fichero' => $this->faker->imageUrl(200, 200, 'travel'),
            'titulo' => $this->faker->sentence(3),
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
