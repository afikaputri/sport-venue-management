<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipmentRental;
use App\Models\Equipment;
use App\Models\Member;
use Faker\Factory as Faker;
use Carbon\Carbon;

class EquipmentRentalSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $members = Member::all();
        $equipments = Equipment::all();

        if ($members->isEmpty() || $equipments->isEmpty()) {
            return;
        }

        for ($i = 1; $i <= 15; $i++) {
            $member = $members->random();
            $equipment = $equipments->random();
            
            $jumlah = rand(1, 3);
            $durasi_jam = rand(1, 4);
            $total_biaya = $jumlah * $durasi_jam * $equipment->harga_sewa_per_jam;
            $status = $faker->randomElement(['Dipinjam', 'Dikembalikan', 'Terlambat']);
            
            EquipmentRental::create([
                'kode_penyewaan' => 'RNT-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'member_id' => $member->id,
                'equipment_id' => $equipment->id,
                'tanggal_sewa' => Carbon::now()->subDays(rand(1, 30))->format('Y-m-d'),
                'jumlah' => $jumlah,
                'durasi_jam' => $durasi_jam,
                'total_biaya' => $total_biaya,
                'status' => $status,
            ]);
        }
    }
}
