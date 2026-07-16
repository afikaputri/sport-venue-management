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
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'owner@sportvenue.test',
            'role' => 'Pemilik',
            'status' => 'Aktif',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@sportvenue.test',
            'role' => 'Staff',
            'status' => 'Aktif',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Member',
            'email' => 'member@sportvenue.test',
            'role' => 'Member',
            'status' => 'Aktif',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            VenueSeeder::class,
            CourtTypeSeeder::class,
            CourtSeeder::class,
        ]);
    }
}
