<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Articulo;
use App\Models\Proveedor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Hugo',
            'email' => 'hugo@hugo.hugo',
            'password' => 'hugo'
        ]);
        Proveedor::factory()->count(10)->create();
        Articulo::factory()->count(50)->create();
    }
}
