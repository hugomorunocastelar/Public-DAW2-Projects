<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\Cliente::factory(50)->create();

        \App\Models\Empleado::factory(20)->create();

        \App\Models\Viaje::factory(30)->create()->each(function ($viaje) {
            // Por cada viaje, crear 5 documentos y 5 fotos
            \App\Models\DocumentoViaje::factory(5)->create([
                'viaje_id' => $viaje->id,
            ]);

            \App\Models\FotoViaje::factory(5)->create([
                'viaje_id' => $viaje->id,
            ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    });
}
}
