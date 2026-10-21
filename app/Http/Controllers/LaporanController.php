<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $pemesanans = null;
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        // Jika user melakukan filter berdasarkan tanggal
        if ($tanggalMulai && $tanggalSelesai) {
            $pemesanans = Pemesanan::with(['user', 'jadwal.film'])
                ->whereBetween('created_at', [$tanggalMulai . ' 00:00:00', $tanggalSelesai . ' 23:59:59'])
                ->get();
        } else {
            // Default tampilkan semua atau kosongkan sebelum difilter
            $pemesanans = Pemesanan::with(['user', 'jadwal.film'])->latest()->get();
        }

        return view('admin.laporan.index', compact('pemesanans', 'tanggalMulai', 'tanggalSelesai'));
    }
}