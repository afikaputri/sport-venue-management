<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourtTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Futsal',
            'Badminton',
            'Basket',
            'Mini Soccer',
            'Tenis',
        ];

        foreach ($types as $type) {
            \App\Models\CourtType::factory()->create([
                'nama_jenis' => $type,
            ]);
        }
    }
}
