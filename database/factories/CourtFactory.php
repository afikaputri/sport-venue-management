<?php

namespace Database\Factories;

use App\Models\Court;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Court>
 */
class CourtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'venue_id' => \App\Models\Venue::factory(),
            'court_type_id' => \App\Models\CourtType::factory(),
            'kode_lapangan' => 'LAP-' . strtoupper($this->faker->bothify('???-###')),
            'nama_lapangan' => 'Lapangan ' . $this->faker->numberBetween(1, 10),
            'harga_per_jam' => $this->faker->numberBetween(50, 300) * 1000,
            'kapasitas' => $this->faker->numberBetween(10, 50),
            'status' => $this->faker->randomElement(['Aktif', 'Tidak Aktif']),
            'deskripsi' => $this->faker->sentence(),
        ];
    }
}
