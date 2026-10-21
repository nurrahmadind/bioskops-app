<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Lihat Daftar Penonton
    public function index()
    {
        // Menampilkan user yang rolenya 'customer' atau 'user' (selain admin)
        $penontons = User::where('role', '!=', 'admin')->latest()->get();
        return view('admin.penontons.index', compact('penontons'));
    }

    // Form Tambah Penonton
    public function create()
    {
        return view('admin.penontons.create');
    }

    // Simpan Penonton Baru
    public function store(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'role'     => 'required|in:customer,admin',
        'password' => 'required|string|min:8',
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'role'     => $request->role, // Menangkap role dari form
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('penontons.index')->with('success', 'Akun penonton/user berhasil ditambahkan!');
}

    // Form Edit Penonton
    public function edit($id)
    {
        $penonton = User::findOrFail($id);
        return view('admin.penontons.edit', compact('penonton'));
    }

    // Update Data Penonton
    public function update(Request $request, $id)
    {
        $penonton = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        // Jika password diisi, update password baru
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8']);
            $data['password'] = Hash::make($request->password);
        }

        $penonton->update($data);

        return redirect()->route('penontons.index')->with('success', 'Data Penonton berhasil diperbarui!');
    }

    // Hapus Data Penonton
    public function destroy($id)
    {
        $penonton = User::findOrFail($id);
        $penonton->delete();

        return redirect()->route('penontons.index')->with('success', 'Data Penonton berhasil dihapus!');
    }
}