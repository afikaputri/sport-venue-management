<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $venues = \App\Models\Venue::all();
        $types = \App\Models\CourtType::all();

        if ($venues->isEmpty() || $types->isEmpty()) {
            return; // Pastikan data master ada dulu
        }

        for ($i = 1; $i <= 30; $i++) {
            \App\Models\Court::factory()->create([
                'venue_id' => $venues->random()->id,
                'court_type_id' => $types->random()->id,
                'kode_lapangan' => 'LAP-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_lapangan' => 'Lapangan ' . $i,
            ]);
        }
    }
}
