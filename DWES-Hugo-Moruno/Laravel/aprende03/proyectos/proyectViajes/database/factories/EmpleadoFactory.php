<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    protected $model = Empleado::class;

    public function definition()
    {
        return [
            'nif' => $this->faker->unique()->numerify('###########'),
            'nombre' => $this->faker->firstName,
            'apellido1' => $this->faker->lastName,
            'apellido2' => $this->faker->optional()->lastName,
            'fecha_nacimiento' => $this->faker->date(),
            'foto' => $this->faker->imageUrl(),
            'observaciones' => $this->faker->paragraph(),
            'active' => $this->faker->boolean(),
        ];
    }
}
