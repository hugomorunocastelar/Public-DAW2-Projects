<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    protected $model = \App\Models\Empleado::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nif' => strtoupper($this->faker->unique()->regexify('[A-Z]{1}[0-9]{8}[A-Z]{1}')), // Ejemplo NIF
            'nombre' => $this->faker->firstName(),
            'apellido1' => $this->faker->lastName(),
            'apellido2' => $this->faker->lastName(),
            'fecha_nacimiento' => $this->faker->date(),
            'foto' => $this->faker->imageUrl(200, 200, 'people'),
            'observaciones' => $this->faker->sentence(),
            'active' => $this->faker->boolean(),
        ];
    }
}
