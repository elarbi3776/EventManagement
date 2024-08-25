<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Permission::create(['name' => 'create event']);
        Permission::create(['name' => 'edit event']);
        Permission::create(['name' => 'delete event']);
        Permission::create(['name' => 'reserve ticket']);
       

        $organizerRole = Role::findByName('Organizer');
        $organizerRole->givePermissionTo(['create event', 'edit event', 'delete event']);

        $participantRole = Role::findByName('Participant');
        $participantRole->givePermissionTo('reserve ticket');
    }
}
