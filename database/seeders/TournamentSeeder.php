<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tournament;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TournamentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {
            $startDate = Carbon::now()->addDays(rand(-10, 30));
            $endDate = (clone $startDate)->addDays(rand(1, 5));
            
            $status = $startDate->isPast() && $endDate->isPast() ? 'Selesai' : ($startDate->isFuture() ? 'Aktif' : 'Aktif');
            if (rand(1, 10) > 8) $status = 'Ditunda';
            
            Tournament::create([
                'kode_turnamen' => 'TRN-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_turnamen' => 'Turnamen ' . $faker->randomElement(['Futsal', 'Basket', 'Voli', 'Badminton']) . ' ' . $faker->city,
                'tanggal_mulai' => $startDate->format('Y-m-d'),
                'tanggal_selesai' => $endDate->format('Y-m-d'),
                'biaya_pendaftaran' => $faker->randomElement([50000, 100000, 150000, 200000]),
                'status' => $status,
            ]);
        }
    }
}
