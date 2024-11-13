<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

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
            $oldPhotoPath = public_path('images/perusahaan_profile/' . $currentPhoto);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }

        // Store the new profile picture
        $imageName = time() . '.' . $file->extension(); // Menambahkan timestamp ke nama file
        $file->move(public_path('images/perusahaan_profile'), $imageName);

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
            $oldPhotoPath = public_path('images/mahasiswa_profile/' . $currentPhoto);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }

        // Store the new profile picture
        $imageName = time() . '.' . $file->extension(); // Menambahkan timestamp ke nama file
        $file->move(public_path('images/mahasiswa_profile'), $imageName);

        return $imageName;
    }
}
