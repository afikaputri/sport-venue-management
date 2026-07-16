<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $venues = [
            'Arena Makassar',
            'Victory Sport Center',
            'Champion Arena',
            'Galaxy Sport Hall',
            'Sport Center Panakkukang',
            'Bumi Serpong Sport',
            'Elite Sports Hub',
            'Jakarta International Stadium Arena',
            'Bandung Sport Complex',
            'Surabaya Indoor Arena',
        ];

        foreach ($venues as $venue) {
            \App\Models\Venue::factory()->create([
                'nama_venue' => $venue,
            ]);
        }
    }
}
