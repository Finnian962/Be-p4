<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'praktijkmanagement',
            'email' => 'praktijkmanagement@smilepro.nl',
            'rolename' => 'praktijkmanagement',
        ]);

        User::factory()->create([
            'name' => 'patient',
            'email' => 'patient@smilepro.nl',
            'rolename' => 'patient',
        ]);

        User::factory()->create([
            'name' => 'Tandarts',
            'email' => 'tandarts@smilepro.nl',
            'rolename' => 'tandarts',
        ]);

        User::factory()->create([
            'name' => 'Mondhygiënist',
            'email' => 'mondhygienist@smilepro.nl',
            'rolename' => 'mondhygienist',
        ]);

        User::factory()->create([
            'name' => 'Assistent',
            'email' => 'assistent@smilepro.nl',
            'rolename' => 'assistent',
        ]);
    }
}
