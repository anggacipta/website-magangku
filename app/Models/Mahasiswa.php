<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'deskripsi'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'mahasiswa_id');
    }

    public function riwayatMagang(): HasOne
    {
        return $this->hasOne(RiwayatMagang::class, 'mahasiswa_id');
    }

    public function keahlian(): BelongsToMany
    {
        return $this->belongsToMany(Keahlian::class, 'keahlian_mahasiswa');
    }

    public function pelamar(): HasOne
    {
        return $this->hasOne(Pelamar::class, 'mahasiswa_id');
    }
}
