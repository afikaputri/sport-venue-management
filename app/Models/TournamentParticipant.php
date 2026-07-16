<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TournamentParticipant extends Model
{
    protected $fillable = [
        'tournament_id',
        'member_id',
        'tanggal_daftar',
        'status',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
