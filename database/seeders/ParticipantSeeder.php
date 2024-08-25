<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'participant',
            'email' => 'participant@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),

            ])->assignRole('Participant');
    }
}
