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
        $rolesAD = ['Administrador'];
        foreach ($rolesAD as $role) {
            Role::create(['name' => $role]);
        }

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'castelar',
        ]);
        $user->syncRoles($rolesAD);

        $rolesUS = ['Usuario'];
        foreach ($rolesUS as $role) {
            Role::create(['name' => $role]);
        }

        $user = User::factory()->create([
            'name' => 'Usuario',
            'email' => 'usuario@gmail.com',
            'password' => 'castelar',
        ]);
        $user->syncRoles($rolesUS);

    }
}
