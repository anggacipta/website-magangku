<?php


namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadSuratPerusahaanService
{
    public function handleFileUploadSuratPerusahaan(UploadedFile $file, $currentFile = null)
    {
        // If the file is null, return the current file
        if (is_null($file)) {
            return $currentFile;
        }

        // Delete the old file if it exists
        if ($currentFile) {
            Storage::disk('public')->delete('surat_perusahaan/' . $currentFile);
        }

        // Store the new file
        $fileName = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->put('surat_perusahaan/' . $fileName, file_get_contents($file));

        return $fileName;
    }
}
