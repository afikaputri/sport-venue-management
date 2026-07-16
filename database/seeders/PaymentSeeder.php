<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Booking;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $bookings = Booking::all();

        if ($bookings->isEmpty()) {
            return;
        }

        // Limit to 20 or less depending on available bookings
        $count = min(20, $bookings->count());
        $selectedBookings = $bookings->random($count);

        foreach ($selectedBookings as $booking) {
            $status = $faker->randomElement(['DP', 'Lunas', 'Refund']);
            $jumlah = $status == 'DP' ? $booking->subtotal / 2 : $booking->subtotal;
            
            Payment::create([
                'booking_id' => $booking->id,
                'tanggal_bayar' => Carbon::parse($booking->tanggal_booking)->subDays(rand(1, 3))->format('Y-m-d'),
                'metode_pembayaran' => $faker->randomElement(['Cash', 'Transfer Bank', 'QRIS', 'Kartu Debit', 'Kartu Kredit']),
                'jumlah_bayar' => $jumlah,
                'status_pembayaran' => $status,
                'catatan' => $faker->sentence(),
            ]);

            // Update booking status accordingly
            if ($status == 'DP') {
                $booking->status_booking = 'Dikonfirmasi';
            } elseif ($status == 'Lunas') {
                $booking->status_booking = 'Selesai';
            } elseif ($status == 'Refund') {
                $booking->status_booking = 'Dibatalkan';
            }
            $booking->save();
        }
    }
}
