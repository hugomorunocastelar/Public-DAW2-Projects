<?php

namespace Database\Seeders;

use App\Models\Concepto;
use App\Models\Gasto;
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
        $this->call(RolesAndPermissionsSeeder::class);

        Concepto::factory()->count(10)->create();
        Gasto::factory()->count(100)->create();
    }
}
