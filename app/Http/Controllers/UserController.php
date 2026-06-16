<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->paginate(5);
        return view('admin.user.index', compact('user'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateUser($request, true);
        User::create($validatedData);
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function register(Request $request)
    {
        $validatedData = $this->validateUser($request, true);
        User::create($validatedData);
        return redirect()->route('web.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau Password salah!');
        }

        Auth::login($user);

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('web.home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('web/login')->with('success', 'Logout berhasil!');
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $this->validateUser($request, false, $user->id);

        // Hapus gambar lama jika ada upload baru
        if ($request->hasFile('gambar') && $user->gambar) {
            $oldPath = public_path($user->gambar);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $user->update($validatedData);
        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if ($user->gambar) {
            $path = public_path($user->gambar);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }

    public function getReservations(User $user)
    {
        return response()->json($user->reservasi ?? []);
    }

    public function getReviews(User $user)
    {
        return response()->json($user->review ?? []);
    }

    private function validateUser(Request $request, $isNewUser = true, $id = null)
    {
        $rules = [
            'nama_pelanggan' => 'required|string|max:255',
            'telepon'        => 'required|string|max:15|unique:users,telepon' . ($id ? ",$id" : ''),
            'email'          => 'required|string|email|unique:users,email' . ($id ? ",$id" : ''),
            'password'       => $isNewUser ? 'required|string|min:8' : 'nullable|string|min:8',
            'gambar'         => $isNewUser ? 'required|image|max:5000' : 'nullable|image|max:5000',
        ];

        $validatedData = $request->validate($rules);

        if ($request->hasFile('gambar')) {
            $file     = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('public/images/'), $fileName);
            $validatedData['gambar'] = 'public/images/' . $fileName;
        }

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        return $validatedData;
    }
}
