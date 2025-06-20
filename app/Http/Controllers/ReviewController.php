<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews = Review::latest()->paginate(5);
        return view('admin.review.index', compact('reviews'));
    }
    /**
     * Menampilkan form review dan daftar review.
     */
    public function create(Request $request)
    {
        // Ambil semua kategori unik dari tabel menu
        $categories = Menu::select('kategori')->distinct()->pluck('kategori');

        // Filter menu berdasarkan kategori yang dipilih
        $selectedCategory = $request->get('kategori');
        $menus = Menu::when($selectedCategory, function ($query, $selectedCategory) {
                        return $query->where('kategori', $selectedCategory);
                    })->select('id', 'nama_menu', 'harga')->get();

        // Ambil semua review dengan relasi user dan menu
        $reviews = Review::with(['user', 'menu:id,nama_menu,harga'])
                        ->latest()
                        ->paginate(10);

        return view('web.review', compact('reviews', 'menus', 'categories', 'selectedCategory'));
    }

    /**
     * Menyimpan review baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'note' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'id_menu' => 'required|exists:menus,id',
        ]);

        // Simpan review ke database
        Review::create([
            'id_user' => Auth::id(),
            'id_menu' => $validatedData['id_menu'],
            'rating' => $validatedData['rating'],
            'note' => $validatedData['note'],
        ]);

        return redirect()->route('web.review')->with('success', 'Review berhasil ditambahkan!');
    }

    /**
     * Menampilkan satu review berdasarkan ID.
     */
    public function show($id)
    {
        $review = Review::with(['user', 'menu:id,nama_menu,harga'])->findOrFail($id);
        return view('web.review_show', compact('review'));
    }

    /**
     * Menampilkan form untuk mengedit review.
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);

        if ($review->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $menus = Menu::select('id', 'nama_menu', 'harga')->get();
        return view('web.review_edit', compact('review', 'menus'));
    }

    /**
     * Memperbarui data review yang ada.
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if ($review->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'note' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'id_menu' => 'required|exists:menus,id',
        ]);

        $review->update([
            'id_menu' => $validatedData['id_menu'],
            'rating' => $validatedData['rating'],
            'note' => $validatedData['note'],
        ]);

        return redirect()->route('web.review')->with('success', 'Review berhasil diperbarui!');
    }

    /**
     * Menghapus review dari database.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $review->delete();

        return redirect()->route('web.review')->with('success', 'Review berhasil dihapus!');
    }
}