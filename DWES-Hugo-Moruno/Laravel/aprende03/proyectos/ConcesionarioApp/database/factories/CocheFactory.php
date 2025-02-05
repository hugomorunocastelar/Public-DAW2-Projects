<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\ModelosCoche;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coche>
 */
class CocheFactory extends Factory
{

    public function definition()
    {
        $cliente = $this->faker->boolean(35) ? Cliente::inRandomOrder()->first() : null;

        return [
            'color' => $this->faker->safeColorName,
            'matricula' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}[A-Z]{1}'),
            'cliente_id' => $cliente ? $cliente->id : null,
            'modelo_coche_id' => ModelosCoche::inRandomOrder()->first()->id,
            'vendido' => (bool)$cliente,
        ];
    }
}
