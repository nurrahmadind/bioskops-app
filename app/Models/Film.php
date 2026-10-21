<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar data bisa disimpan melalui Form
    protected $fillable = [
        'judul_film',
        'genre',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}