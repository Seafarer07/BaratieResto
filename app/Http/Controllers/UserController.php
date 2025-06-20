<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::latest()->paginate(5);
        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateUser($request, true);
        User::create($validatedData);
        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $validatedData = $this->validateUser($request, true);
        User::create($validatedData);
        return redirect()->route('web.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Login a user.
     */
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau Password salah!');
        }

        if ($request->email === 'admin@gmail.com' && $request->password === 'admin12345' ) {
            Auth::login($user);
            return view('/admin/dashboard');
        } else {
            Auth::login($user);
            return redirect()->route('web.home');
        }
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('web/login')->with('success', 'Logout berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $this->validateUser($request, false, $user->id);

        // Update gambar jika ada
        if ($request->hasFile('gambar')) {
            if ($user->gambar && Storage::exists($user->gambar)) {
                Storage::delete($user->gambar);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('public/images');
        }

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $user->update($validatedData);
        return redirect()->route('admin.user.index')->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->gambar && Storage::exists($user->gambar)) {
            Storage::delete($user->gambar);
        }
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus!');
    }

    /**
     * Display reservations for the specified user.
     */
    public function getReservations(User $user)
    {
        $reservations = $user->reservasi ?? [];
        return response()->json($reservations);
    }

    /**
     * Display reviews for the specified user.
     */
    public function getReviews(User $user)
    {
        $reviews = $user->reviews ?? [];
        return response()->json($reviews);
    }

    /**
     * Common validation for user operations.
     */
    private function validateUser(Request $request, $isNewUser = true, $id = null)
    {
        $rules = [
            'nama_pelanggan' => 'required|string|max:255',
            'telepon' => 'required|string|max:15|unique:users,telepon' . ($id ? ",$id" : ''),
            'email' => 'required|string|email|unique:users,email' . ($id ? ",$id" : ''),
            'password' => $isNewUser ? 'required|string|min:8' : 'nullable|string|min:8',
            'gambar' => $isNewUser ? 'required|image|max:5000' : 'nullable|image|max:5000',
        ];

        $validatedData = $request->validate($rules);

        if ($request->hasFile('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('public/images');
        }

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        return $validatedData;
    }
}
