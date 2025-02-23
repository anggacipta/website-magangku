<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FotoKegiatanService
{
    public function handleFileUpload(UploadedFile $file)
    {
        // Store the new profile picture
        $imageName = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        // Menambahkan timestamp ke nama file
        Storage::disk('public')->put('images/foto_kegiatan/' . $imageName, file_get_contents($file));

        return $imageName;
    }
}