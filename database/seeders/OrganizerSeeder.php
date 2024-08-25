<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OrganizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Vérifier si l'utilisateur existe déjà et le créer s'il n'existe pas
        $organizer = User::firstOrCreate(
            ['email' => 'organizer@gmail.com'], // Condition de recherche
            [
                'name' => 'organizer',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Utiliser Hash::make pour le mot de passe

                ]
        );

        // Assigner le rôle d'organisateur
        $organizer->assignRole('Organizer');

        // Assigner également le rôle de participant
        $organizer->assignRole('Participant');
    }
}
