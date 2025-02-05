<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nif' => fake()->regexify('[0-9]{8}[A-Z]{1}'),
            'nombre' => fake()->firstName(),
            'apellido1' => fake()->lastName(),
            'apellido2' => fake()->optional()->lastName,
            'fecha_nacimiento' => $this->faker->optional()->date(),
            // 'foto' => $this->faker->optional()->imageUrl(100, 100, 'people'),
            'observaciones' => $this->faker->optional()->paragraph,
            'active' => $this->faker->boolean(90),
        ];
    }
}
