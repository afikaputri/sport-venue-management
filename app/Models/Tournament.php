<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'kode_turnamen',
        'nama_turnamen',
        'tanggal_mulai',
        'tanggal_selesai',
        'biaya_pendaftaran',
        'status',
    ];

    public function participants()
    {
        return $this->hasMany(TournamentParticipant::class);
    }
}
