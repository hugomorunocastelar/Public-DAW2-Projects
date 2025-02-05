<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Coche;
use App\Models\Marca;
use App\Models\ModelosCoche;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\ClienteFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);

        Cliente::factory()->count(10)->create();
        Marca::factory()->count(5)->create();
        ModelosCoche::factory()->count(20)->create();
        Coche::factory()->count(30)->create();
    }
}
