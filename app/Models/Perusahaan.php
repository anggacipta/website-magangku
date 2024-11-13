<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perusahaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'deskripsi'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'perusahaan_id');
    }
}
