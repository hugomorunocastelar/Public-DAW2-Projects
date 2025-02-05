<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['USER', 'ADMIN', 'CLIENTE', 'EMPLE'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.admin',
            'password' => 'admin',
        ]);
        $user->syncRoles($roles);
    }
}
