<?php

namespace Database\Factories;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ModelosCocheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'identificador' => $this->faker->unique()->regexify('DD-[A-Z]{2}'),
            'nombre' => $this->faker->word,
            'tipo' => $this->faker->randomElement(['SUV', 'Sedán', 'Hatchback', 'Coupé', 'Pick-up']),
            'anho' => $this->faker->numberBetween(2000, 2024),
            'marca_id' => Marca::inRandomOrder()->first()->id,
            'imagen' => null
        ];
    }
}
