<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKP extends Model
{
    use HasFactory;

    protected $table = 'surat_kp';

    protected $fillable = [
        'tanggal_mulai',
        'tanggal_selesai',
        'nama_perusahaan',
        'alamat_perusahaan',
        'mahasiswa',
        'nomor_surat',
        'status_surat',
        'upload_surat',
    ];

    protected $casts = [
        'mahasiswa' => 'array'
    ];
}
