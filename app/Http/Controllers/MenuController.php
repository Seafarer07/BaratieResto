<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = Menu::latest()->paginate(5); // Mengambil semua data menu
        return view('admin.menu.index', compact('menu'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'image' => 'required|image|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('public/images/'), $fileName);
            $validatedData['image'] = 'public/images/' . $fileName;
        }

        $menu = Menu::create($validatedData); // Membuat menu baru

        try {
            $menu = Menu::latest()->paginate(5); // Mengambil semua data menu
            return view('admin.menu.index', compact('menu'));
        } catch (\Exception $e) {
            $menu = Menu::latest()->paginate(5); // Mengambil semua data menu
            return view('admin.menu.index', compact('menu'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return response()->json($menu); // Mengembalikan data menu berdasarkan ID
    }



    /**
     * Update the specified resource in storage.
     */

     public function edit($id)
     {
         $menu = Menu::find($id);
         return view('admin.menu.edit', compact('menu'));
     }

    public function update(Request $request, $id)
    {

        $menu = Menu::find($id);

        $validatedData = $request->validate([
            'nama_menu' => 'sometimes|required|string|max:255',
            'kategori' => 'sometimes|required|string|max:255',
            'harga' => 'sometimes|required|numeric|min:0',
            'image' => 'sometimes|required|image|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('public/images/'), $fileName);
            $validatedData['image'] = 'public/images/' . $fileName;
        }

        $menu->update($validatedData); // Membuat menu baru

        try {
            $menu = Menu::latest()->paginate(5); // Mengambil semua data menu
            return view('admin.menu.index', compact('menu'));
        } catch (\Exception $e) {
            $menu = Menu::latest()->paginate(5); // Mengambil semua data menu
            return view('admin.menu.index', compact('menu'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete(); // Menghapus menu
        try {
            $menu = Menu::latest()->paginate(5); // Mengambil semua data menu
            return view('admin.menu.index', compact('menu'));
        } catch (\Exception $e) {
            $menu = Menu::latest()->paginate(5); // Mengambil semua data menu
            return view('admin.menu.index', compact('menu'));
        }
    }

    /**
     * Display reviews for the specified menu.
     */
    public function getReviews(Menu $menu)
    {
        $reviews = $menu->review; // Mengambil data review yang terkait
        return response()->json($reviews);
    }
}
