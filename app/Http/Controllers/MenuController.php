<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::latest()->paginate(5);
        return view('admin.menu.index', compact('menu'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori'  => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
            'image'     => 'required|image|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $image    = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('public/images/'), $fileName);
            $validatedData['image'] = 'public/images/' . $fileName;
        }

        Menu::create($validatedData);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function show(Menu $menu)
    {
        return response()->json($menu);
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validatedData = $request->validate([
            'nama_menu' => 'sometimes|required|string|max:255',
            'kategori'  => 'sometimes|required|string|max:255',
            'harga'     => 'sometimes|required|numeric|min:0',
            'image'     => 'sometimes|required|image|max:5000',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($menu->image && file_exists(public_path($menu->image))) {
                unlink(public_path($menu->image));
            }

            $image    = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('public/images/'), $fileName);
            $validatedData['image'] = 'public/images/' . $fileName;
        }

        $menu->update($validatedData);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image && file_exists(public_path($menu->image))) {
            unlink(public_path($menu->image));
        }

        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus!');
    }

    public function getReviews(Menu $menu)
    {
        return response()->json($menu->review);
    }
}
