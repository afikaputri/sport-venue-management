<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'phone', 'role', 'status', 'profile_photo', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'user_id');
    }

    protected static function booted()
    {
        static::created(function ($user) {
            if (strtolower($user->role) === 'member' || strtolower($user->role) === 'pelanggan') {
                // Hindari duplikasi jika sudah dibuat manual
                if (!$user->member) {
                    \App\Models\Member::create([
                        'user_id' => $user->id,
                        'kode_member' => 'MBR-' . time() . rand(10,99),
                        'nama_member' => $user->name,
                        'email' => $user->email,
                        'nomor_hp' => $user->phone ?? null,
                        'status' => 'Aktif',
                        'tanggal_bergabung' => now()->toDateString(),
                    ]);
                }
            }
        });
    }
}
