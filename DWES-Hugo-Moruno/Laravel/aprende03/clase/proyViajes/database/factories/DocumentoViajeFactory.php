<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentoViaje>
 */
class DocumentoViajeFactory extends Factory
{
    protected $model = \App\Models\DocumentoViaje::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'viaje_id' => \App\Models\Viaje::factory(),
            'fichero' => $this->faker->filePath(),
            'titulo' => $this->faker->sentence(3),
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
