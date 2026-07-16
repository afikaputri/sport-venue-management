<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    /** @use HasFactory<\Database\Factories\VenueFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_venue',
        'alamat',
        'nomor_telepon',
        'email',
        'jam_operasional',
        'deskripsi',
        'status',
    ];

    public function courts()
    {
        return $this->hasMany(Court::class);
    }
}
