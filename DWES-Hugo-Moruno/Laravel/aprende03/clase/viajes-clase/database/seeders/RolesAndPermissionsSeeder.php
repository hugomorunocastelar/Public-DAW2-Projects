<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['USER', 'ADMIN', 'CLIENT', 'EMPLE'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
        $user = User::factory()->create([
            'name' => 'Hugo',
            'email' => 'hugo@hugo.com',
            'password' => 'hugo',
        ]);
        $user->assignRole($roles);

    }
}
