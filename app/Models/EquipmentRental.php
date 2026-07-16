<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentRental extends Model
{
    protected $fillable = [
        'kode_penyewaan',
        'member_id',
        'equipment_id',
        'tanggal_sewa',
        'jumlah',
        'durasi_jam',
        'total_biaya',
        'status',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
