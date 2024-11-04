<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
}
