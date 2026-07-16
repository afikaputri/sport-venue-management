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
            'name' => 'Budi Pemilik',
            'email' => 'pemilik@example.com',
            'role' => 'Pemilik',
            'status' => 'Aktif',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Siti Staff',
            'email' => 'staff@example.com',
            'role' => 'Staff',
            'status' => 'Aktif',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Andi Member',
            'email' => 'member@example.com',
            'role' => 'Member',
            'status' => 'Aktif',
            'password' => bcrypt('password'),
        ]);
    }
}
