<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{
    /**
     * Menampilkan semua reservasi.
     */
    public function index()
    {
        // Ambil semua reservasi dengan relasi user dan meja
        $reservasi = Reservasi::with(['user', 'meja'])->paginate(10);
        return view('admin.reservasi.index', compact('reservasi'));
    }

    /**
     * Menampilkan form reservasi.
     */
    public function create()
    {
        return view('web.reservation');
    }

    /**
     * Menyimpan reservasi baru.
     */
    public function store(Request $request)
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('web.login')->with('error', 'Silakan login untuk melakukan reservasi.');
        }

        // Validasi input
        $validatedData = $request->validate([
            'jenis' => 'required|string',
            'tanggal_reservasi' => 'required|date|after:today',
            'note' => 'nullable|string',
        ]);

        // Cek ketersediaan meja
        $jenisMeja = $request->input('jenis');
        $mejaTersedia = Meja::where('jenis', $jenisMeja)
            ->where('status', false)
            ->inRandomOrder()
            ->first();

        if (!$mejaTersedia) {
            return back()->withErrors(['jenis' => 'Maaf, tidak ada meja tersedia untuk jenis yang dipilih.'])->withInput();
        }

        // Simpan reservasi + lock meja dalam satu transaksi atomik
        DB::transaction(function () use ($mejaTersedia, $request) {
            Reservasi::create([
                'id_meja'           => $mejaTersedia->id,
                'id_user'           => Auth::id(),
                'tanggal_reservasi' => $request->input('tanggal_reservasi'),
                'note'              => $request->input('note'),
            ]);

            $mejaTersedia->update(['status' => true]);
        });

        return redirect()->route('web.home')->with('success', 'Reservasi berhasil dibuat.');
    }

    /**
     * Menampilkan detail reservasi.
     */
    public function show(Reservasi $reservasi)
    {
        $reservasi->load(['user', 'meja']); // Memuat relasi user dan meja
        return response()->json($reservasi);
    }

    /**
     * Menampilkan form edit reservasi.
     */
    public function edit($id)
    {
        $reservasi = Reservasi::with(['user', 'meja'])->findOrFail($id);
        return view('admin.reservasi.edit', compact('reservasi'));
    }

    /**
     * Memperbarui data reservasi.
     */
    public function update(Request $request, Reservasi $reservasi)
    {
        $validatedData = $request->validate([
            'tanggal_reservasi' => 'sometimes|required|date',
            'note' => 'nullable|string',
            'id_meja' => 'sometimes|required|exists:mejas,id',
        ]);

        $reservasi->update($validatedData);
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    /**
     * Menghapus reservasi.
     */
    public function destroy(Reservasi $reservasi)
    {
        // Update status meja menjadi tersedia
        $meja = Meja::find($reservasi->id_meja);
        if ($meja) {
            $meja->update(['status' => false]);
        }

        $reservasi->delete();
        return response()->json(['message' => 'Reservasi berhasil dihapus.']);
    }
}