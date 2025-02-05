<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Viaje>
 */
class ViajeFactory extends Factory
{
    protected $model = \App\Models\Viaje::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titulo = $this->faker->sentence(3);
        return [
            'referencia' => strtoupper(Str::random(10)),
            'titulo' => $titulo,
            'slug' => Str::slug($titulo) . '-' . Str::random(5),
            'precio' => $this->faker->randomFloat(2, 100, 5000),
            'participantes' => $this->faker->numberBetween(1, 100),
            'salida' => $this->faker->dateTimeBetween('+0 days', '+1 year'),
            'llegada' => $this->faker->dateTimeBetween('+1 year', '+2 years'),
            'foto' => $this->faker->imageUrl(100, 100, 'travel'),
            'descripcion' => $this->faker->paragraph(),
            'active' => $this->faker->boolean(),
        ];
    }
}
