<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::latest()->get();
        return view('admin.films.index', compact('films'));
    }

    public function create()
    {
        return view('admin.films.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_film' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
        ]);

        Film::create([
            'judul_film' => $request->judul_film,
            'genre' => $request->genre,
        ]);

        return redirect()->route('films.index')->with('success', 'Film berhasil ditambahkan!');
    }

    public function edit(Film $film)
    {
        return view('admin.films.edit', compact('film'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'judul_film' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
        ]);

        $film->update([
            'judul_film' => $request->judul_film,
            'genre' => $request->genre,
        ]);

        return redirect()->route('films.index')->with('success', 'Film berhasil diperbarui!');
    }

    public function destroy(Film $film)
    {
        $film->delete();
        return redirect()->route('films.index')->with('success', 'Film berhasil dihapus!');
    }
}