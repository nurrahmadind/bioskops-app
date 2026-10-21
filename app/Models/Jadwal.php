<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- Tambahkan baris ini
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'waktu_tayang',
        'harga',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}