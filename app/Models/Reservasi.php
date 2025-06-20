<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jumlah_orang',
        'tanggal_reservasi',
        'note',
        'id_meja',
        'id_user',
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'id', 'id_meja');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_user');
    }
}
