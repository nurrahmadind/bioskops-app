<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index()
    {
        // Jika admin, lihat semua pemesanan. Jika user biasa, lihat pemesanan miliknya sendiri.
        if (Auth::user()->role === 'admin') {
            $pemesanans = Pemesanan::with(['user', 'jadwal.film'])->latest()->get();
        } else {
            $pemesanans = Pemesanan::with(['user', 'jadwal.film'])->where('user_id', Auth::id())->latest()->get();
        }

        return view('pemesanans.index', compact('pemesanans'));
    }

    public function create()
    {
        $jadwals = Jadwal::with('film')->get();
        return view('pemesanans.create', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'jumlah_tiket' => 'required|integer|min:1',
        ]);

        // Ambil data jadwal untuk mendapatkan harga
        $jadwal = Jadwal::findOrFail($request->jadwal_id);
        
        // Hitung total harga otomatis
        $totalHarga = $jadwal->harga * $request->jumlah_tiket;

        Pemesanan::create([
            'user_id' => Auth::id(), // ID user yang sedang login
            'jadwal_id' => $request->jadwal_id,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $totalHarga,
        ]);

        return redirect()->route('pemesanans.index')->with('success', 'Tiket berhasil dipesan!');
    }
}