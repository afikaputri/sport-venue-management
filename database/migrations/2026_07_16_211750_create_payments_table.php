<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->date('tanggal_bayar');
            $table->enum('metode_pembayaran', ['Cash', 'Transfer Bank', 'QRIS', 'Kartu Debit', 'Kartu Kredit']);
            $table->decimal('jumlah_bayar', 15, 2);
            $table->enum('status_pembayaran', ['DP', 'Lunas', 'Refund', 'Menunggu Verifikasi']);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
