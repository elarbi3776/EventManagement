<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'name' => 'Mawazin',
            'description' => 'This is an example event.',
            'start_date' => now()->addDays(10),
            'end_date' => now()->addDays(12),
            'location' => 'Rabat',
            'category' => 'Festival',
            'available_tickets' => '1000',
            // Ajoutez d'autres champs nécessaires pour l'événement ici
        ]);
    }
}
