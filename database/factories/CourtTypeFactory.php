<?php

namespace Database\Factories;

use App\Models\CourtType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CourtType>
 */
class CourtTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_jenis' => $this->faker->unique()->word(),
            'deskripsi' => $this->faker->sentence(),
            'status' => 'Aktif',
        ];
    }
}
