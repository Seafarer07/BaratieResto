<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        User::factory()->admin()->create([
            'nama_pelanggan' => 'Administrator',
            'email'          => 'admin@baratie.com',
            'telepon'        => '081234567890',
            'password'       => Hash::make('admin123456'),
            'gambar'         => 'images/default.jpg',
        ]);

        // Buat 10 user pelanggan sample
        User::factory(10)->create();
    }
}
