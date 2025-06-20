<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function profile()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Kirim data user ke view
        return view('web.profile', compact('user'));
    }
    public function update(Request $request, $id)
    {
        // Ambil data user yang akan diupdate
        $user = User::findOrFail($id);

        // Validasi input, email dan gambar bersifat opsional
        $validatedData = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => 'required|string|email|unique:users,email,' . $user->id, // Abaikan email user saat ini
            'password' => 'nullable|string|min:8', // Password tidak wajib diisi
            'gambar' => 'nullable|image|max:5000', // Gambar tidak wajib diunggah
        ]);

        // Update gambar jika ada file baru diunggah
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $fileName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('public/images/'), $fileName);

            // Hapus gambar lama jika ada
            if ($user->gambar && file_exists(public_path($user->gambar))) {
                unlink(public_path($user->gambar));
            }

            $validatedData['gambar'] = 'public/images/' . $fileName;
        }

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            unset($validatedData['password']);
        }

        // Update data user
        $user->update($validatedData);
        return view('web/profile');
    }
}
