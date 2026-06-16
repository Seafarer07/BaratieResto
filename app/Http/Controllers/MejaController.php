<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index()
    {
        $meja = Meja::latest()->paginate(5);
        return view('admin.meja.index', compact('meja'));
    }

    public function create()
    {
        return view('admin.meja.create');
    }

    public function store(Request $request)
    {
        $request->merge(['status' => $request->input('status', false)]);

        $validatedData = $request->validate([
            'jenis'  => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        Meja::create($validatedData);

        return redirect()->route('meja.index')->with('success', 'Meja berhasil ditambahkan!');
    }

    public function show(Meja $meja)
    {
        return response()->json($meja);
    }

    public function edit($id)
    {
        $meja = Meja::findOrFail($id);
        return view('admin.meja.edit', compact('meja'));
    }

    public function update(Request $request, Meja $meja)
    {
        $validatedData = $request->validate([
            'jenis'  => 'sometimes|required|string|max:255',
            'status' => 'sometimes|boolean',
        ]);

        $meja->update($validatedData);

        return redirect()->route('meja.index')->with('success', 'Meja berhasil diperbarui!');
    }

    public function destroy(Meja $meja)
    {
        $meja->delete();

        return redirect()->route('meja.index')->with('success', 'Meja berhasil dihapus!');
    }

    public function getReservations(Meja $meja)
    {
        return response()->json($meja->reservasi);
    }
}
