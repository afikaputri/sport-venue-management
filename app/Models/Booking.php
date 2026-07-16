<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'kode_booking',
        'member_id',
        'court_id',
        'tanggal_booking',
        'jam_mulai',
        'jam_selesai',
        'durasi',
        'harga_per_jam',
        'subtotal',
        'status_booking',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
