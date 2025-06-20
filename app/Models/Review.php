<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'note',
        'rating',
        'id_menu',
        'id_user',
    ];

    /**
     * Relasi ke tabel Menu.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id');
    }

    /**
     * Relasi ke tabel User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}