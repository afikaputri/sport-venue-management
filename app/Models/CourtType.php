<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtType extends Model
{
    /** @use HasFactory<\Database\Factories\CourtTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_jenis',
        'deskripsi',
        'status',
    ];

    public function courts()
    {
        return $this->hasMany(Court::class);
    }
}
