<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
}
