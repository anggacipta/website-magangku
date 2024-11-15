<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    public function handleFileUploadPerusahaan(UploadedFile $file, $currentPhoto = null)
    {
        // If the file is null, return the current photo
        if (is_null($file)) {
            return $currentPhoto;
        }

        // Delete the old profile picture if it exists
        if ($currentPhoto) {
            Storage::disk('public')->delete('images/perusahaan_profile/' . $currentPhoto);
        }

        // Store the new profile picture
        $imageName = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
         // Menambahkan timestamp ke nama file
        Storage::disk('public')->put('images/perusahaan_profile/' . $imageName, file_get_contents($file));

        return $imageName;
    }

    public function handleFileUploadMahasiswa(UploadedFile $file, $currentPhoto = null)
    {
        // If the file is null, return the current photo
        if (is_null($file)) {
            return $currentPhoto;
        }

        // Delete the old profile picture if it exists
        if ($currentPhoto) {
            Storage::disk('public')->delete('images/mahasiswa_profile/' . $currentPhoto);
        }

        // Store the new profile picture
        $imageName = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        // Menambahkan timestamp ke nama file
        Storage::disk('public')->put('images/mahasiswa_profile/' . $imageName, file_get_contents($file));

        return $imageName;
    }
}
