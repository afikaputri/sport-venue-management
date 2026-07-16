<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Member;
use App\Models\Court;
use Carbon\Carbon;
use Faker\Factory as Faker;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $members = Member::all();
        $courts = Court::all();

        if ($members->isEmpty() || $courts->isEmpty()) {
            return;
        }

        for ($i = 1; $i <= 20; $i++) {
            $court = $courts->random();
            $member = $members->random();
            
            $tanggal = Carbon::today()->addDays(rand(1, 30));
            $jam_mulai = rand(8, 20); // 8 AM to 8 PM
            $durasi = rand(1, 3);
            $jam_selesai = $jam_mulai + $durasi;

            $status = $faker->randomElement(['Pending', 'Dikonfirmasi', 'Selesai', 'Dibatalkan']);
            $subtotal = $durasi * $court->harga_per_jam;

            Booking::create([
                'kode_booking' => 'BKG-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'member_id' => $member->id,
                'court_id' => $court->id,
                'tanggal_booking' => $tanggal->format('Y-m-d'),
                'jam_mulai' => str_pad($jam_mulai, 2, '0', STR_PAD_LEFT) . ':00',
                'jam_selesai' => str_pad($jam_selesai, 2, '0', STR_PAD_LEFT) . ':00',
                'durasi' => $durasi,
                'harga_per_jam' => $court->harga_per_jam,
                'subtotal' => $subtotal,
                'status_booking' => $status,
            ]);
        }
    }
}
