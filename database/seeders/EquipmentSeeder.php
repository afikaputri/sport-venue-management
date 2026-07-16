<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $equipments = [
            ['kode_peralatan' => 'EQP-001', 'nama_peralatan' => 'Bola Basket', 'stok' => 10, 'harga_sewa_per_jam' => 20000],
            ['kode_peralatan' => 'EQP-002', 'nama_peralatan' => 'Bola Voli', 'stok' => 15, 'harga_sewa_per_jam' => 15000],
            ['kode_peralatan' => 'EQP-003', 'nama_peralatan' => 'Raket Bulutangkis', 'stok' => 20, 'harga_sewa_per_jam' => 25000],
            ['kode_peralatan' => 'EQP-004', 'nama_peralatan' => 'Sepatu Futsal (Size 40)', 'stok' => 5, 'harga_sewa_per_jam' => 30000],
            ['kode_peralatan' => 'EQP-005', 'nama_peralatan' => 'Rompi Tim (Set 12)', 'stok' => 10, 'harga_sewa_per_jam' => 40000],
        ];

        foreach ($equipments as $equipment) {
            Equipment::create($equipment);
        }
    }
}
