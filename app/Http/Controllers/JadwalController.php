<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Film;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // 1. Menampilkan daftar jadwal
    public function index()
    {
        $jadwals = Jadwal::with('film')->latest()->get();
        return view('admin.jadwals.index', compact('jadwals'));
    }

    // 2. Menampilkan form tambah jadwal
    public function create()
    {
        $films = Film::all();
        return view('admin.jadwals.create', compact('films'));
    }

    // 3. Menyimpan jadwal baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'harga' => 'required|numeric|min:1000',
        ]);

        // Langsung masukkan ke kolom database: tanggal_tayang & jam_tayang
        Jadwal::create([
            'film_id' => $request->film_id,
            'tanggal_tayang' => $request->tanggal,
            'jam_tayang' => $request->jam,
            'harga' => $request->harga,
        ]);

        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit jadwal
    public function edit(Jadwal $jadwal)
    {
        $films = Film::all();
        return view('admin.jadwals.edit', compact('jadwal', 'films'));
    }

    // 5. Memperbarui data jadwal
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'harga' => 'required|numeric|min:1000',
        ]);

        $jadwal->update([
            'film_id' => $request->film_id,
            'tanggal_tayang' => $request->tanggal,
            'jam_tayang' => $request->jam,
            'harga' => $request->harga,
        ]);

        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    // 6. Menghapus jadwal
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}