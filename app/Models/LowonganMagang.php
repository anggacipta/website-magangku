<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LowonganMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'posisi',
        'deskripsi',
        'lokasi_id',
        'durasi',
        'uang_saku',
        'jenis_kerja',
        'pembuat_id',
    ];

    public function pelamars(): BelongsToMany
    {
        return $this->belongsToMany(Pelamar::class, 'lowongan_magang_pelamar');
    }

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembuat_id');
    }
}
