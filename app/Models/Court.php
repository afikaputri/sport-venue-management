<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    /** @use HasFactory<\Database\Factories\CourtFactory> */
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'court_type_id',
        'kode_lapangan',
        'nama_lapangan',
        'harga_per_jam',
        'kapasitas',
        'status',
        'deskripsi',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function courtType()
    {
        return $this->belongsTo(CourtType::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
