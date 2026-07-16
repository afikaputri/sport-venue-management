<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_member',
        'nama_member',
        'jenis_kelamin',
        'nomor_hp',
        'email',
        'alamat',
        'tanggal_bergabung',
        'status',
    ];
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function equipmentRentals()
    {
        return $this->hasMany(EquipmentRental::class);
    }

    public function tournamentParticipants()
    {
        return $this->hasMany(TournamentParticipant::class);
    }
}
