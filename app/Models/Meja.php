<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jenis',
        'status',
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_meja', 'id');
    }
}
