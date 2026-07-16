<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'tanggal_bayar',
        'metode_pembayaran',
        'jumlah_bayar',
        'status_pembayaran',
        'catatan',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
