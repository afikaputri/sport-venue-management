<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [
        'kode_peralatan',
        'nama_peralatan',
        'stok',
        'harga_sewa_per_jam',
    ];

    public function rentals()
    {
        return $this->hasMany(EquipmentRental::class);
    }
}
