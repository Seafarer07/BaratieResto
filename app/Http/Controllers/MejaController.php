<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meja = Meja::latest()->paginate(5); // Mengambil semua data menu
        return view('admin.meja.index', compact('meja'));
    }

    public function create()
    {
        return view('admin.meja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // dd($request->all());

        $request->merge(['status' => $request->input('status', false)]);

        $validatedData = $request->validate([
            'jenis' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $meja = Meja::create($validatedData);

        try {
            $meja = Meja::latest()->paginate(5); // Mengambil semua data meja
            return view('admin.meja.index', compact('meja'));
        } catch (\Exception $e) {
            $meja = Meja::latest()->paginate(5); // Mengambil semua data meja
            return view('admin.meja.index', compact('meja'));
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Meja $meja)
    {
        return response()->json($meja);
    }

    /**
     * Update the specified resource in storage.
     */

     public function edit($id)
     {
        $meja = Meja::find($id);
        return view('admin.meja.edit', compact('meja'));
     }

    public function update(Request $request, Meja $meja)
    {
        $validatedData = $request->validate([
            'jenis' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|boolean',
        ]);

        $meja->update($validatedData);

        try {
            $meja = Meja::latest()->paginate(5); // Mengambil semua data meja
            return view('admin.meja.index', compact('meja'));
        } catch (\Exception $e) {
            $meja = Meja::latest()->paginate(5); // Mengambil semua data meja
            return view('admin.meja.index', compact('meja'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meja $meja)
    {
        $meja->delete();

        try {
            $meja = Meja::latest()->paginate(5); // Mengambil semua data meja
            return view('admin.meja.index', compact('meja'));
        } catch (\Exception $e) {
            $meja = Meja::latest()->paginate(5); // Mengambil semua data meja
            return view('admin.meja.index', compact('meja'));
        }
    }

    /**
     * Display reservations for the specified table.
     */
    public function getReservations(Meja $meja)
    {
        $reservations = $meja->reservasi; // Mengambil data reservasi yang terkait

        return response()->json($reservations);
    }
}
