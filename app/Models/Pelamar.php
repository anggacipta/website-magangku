<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pelamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'status',
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function lowonganMagangs(): BelongsToMany
    {
        return $this->belongsToMany(LowonganMagang::class, 'lowongan_magang_pelamar');
    }
}
