<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pelanggan',
        'telepon',
        'email',
        'password',
        'gambar',
        'is_admin',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kolom dengan tipe data khusus.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi ke tabel Reservasi.
     * Satu User dapat memiliki banyak Reservasi.
     */
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_user', 'id');
    }

    /**
     * Relasi ke tabel Review.
     * Satu User dapat memiliki banyak Review.
     */
    public function review()
    {
        return $this->hasMany(Review::class, 'id_user', 'id');
    }
}
