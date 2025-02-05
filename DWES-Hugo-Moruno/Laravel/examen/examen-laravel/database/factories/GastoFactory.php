<?php

namespace Database\Factories;

use App\Models\Concepto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gasto>
 */
class GastoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'conceptos_id' => Concepto::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'gasto' => $this->faker->numberBetween(0, 1000),
            'imagen' => 'null',
            'fecha' => $this->faker->date()
        ];
    }
}
