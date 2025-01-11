<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LowonganMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'lokasi',
        'durasi',
    ];

    public function pelamars(): BelongsToMany
    {
        return $this->belongsToMany(Pelamar::class, 'lowongan_magang_pelamar');
    }
}
