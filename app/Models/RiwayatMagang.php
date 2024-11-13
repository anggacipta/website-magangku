<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'nama_perusahaan',
        'posisi',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
}
