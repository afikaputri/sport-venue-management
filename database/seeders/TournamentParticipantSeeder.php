<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TournamentParticipant;
use App\Models\Tournament;
use App\Models\Member;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TournamentParticipantSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $tournaments = Tournament::all();
        $members = Member::all();

        if ($tournaments->isEmpty() || $members->isEmpty()) {
            return;
        }

        for ($i = 1; $i <= 20; $i++) {
            $tournament = $tournaments->random();
            $member = $members->random();
            
            // Cek duplikasi manual supaya tidak ada kombinasi yang sama (kalau diperlukan), tp untuk seeder sederhana bisa diabaikan
            TournamentParticipant::create([
                'tournament_id' => $tournament->id,
                'member_id' => $member->id,
                'tanggal_daftar' => Carbon::parse($tournament->tanggal_mulai)->subDays(rand(1, 15))->format('Y-m-d'),
                'status' => $faker->randomElement(['Terdaftar', 'Lolos', 'Gugur']),
            ]);
        }
    }
}
