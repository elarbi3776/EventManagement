<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un utilisateur administrateur
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Utiliser Hash::make pour le mot de passe

        ]);

        // Assigner tous les rôles à l'administrateur
        $roles = Role::all();
        foreach ($roles as $role) {
            $admin->assignRole($role);
        }

        // Assigner toutes les permissions à l'administrateur
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $admin->givePermissionTo($permission);
        }
    }
}
