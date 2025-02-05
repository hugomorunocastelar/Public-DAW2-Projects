<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedor>
 */
class ProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $esPersonaFisica = fake()->boolean();

        return [
            'nif' => $esPersonaFisica ? fake()->regexify('[A-Z]{1}[0-9]{7}[A-Z]{1}') : fake()->regexify('[A-Z]{1}[0-9]{8}'),
            'nombre' => fake()->firstName(),
            'apellido1' => fake()->lastName(),
            'apellido2' => fake()->lastName(),
            'autonomo' => fake()->boolean(),
            'razon_social' => fake()->company(),
            'direccion' => fake()->address(),
            'tlf' => fake()->phoneNumber(),
            'observaciones' => fake()->optional()->sentence(),
        ];
    }
}
