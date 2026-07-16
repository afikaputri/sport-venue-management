<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 20; $i++) {
            Member::create([
                'kode_member' => 'MBR-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_member' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'nomor_hp' => substr($faker->phoneNumber, 0, 20),
                'email' => $faker->unique()->safeEmail,
                'alamat' => $faker->address,
                'tanggal_bergabung' => $faker->date('Y-m-d', 'now'),
                'status' => $faker->randomElement(['Aktif', 'Tidak Aktif']),
            ]);
        }
    }
}
