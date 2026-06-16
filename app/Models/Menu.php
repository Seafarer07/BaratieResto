<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_menu',
        'kategori',
        'harga',
        'image',
    ];

    public function review()
    {
        return $this->hasMany(Review::class, 'id_menu', 'id');
    }
}
