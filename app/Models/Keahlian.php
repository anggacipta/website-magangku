<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Keahlian extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_keahlian',
    ];

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'keahlian_mahasiswa');
    }
}
