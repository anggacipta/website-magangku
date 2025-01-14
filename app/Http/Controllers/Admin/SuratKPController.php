<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NomorSuratKpUpdateRequest;
use App\Http\Requests\SuratKpRequest;
use App\Models\SuratKP;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class SuratKPController extends Controller
{
    public function index()
    {
        $surats = SuratKP::select('id', 'nama_perusahaan', 'tanggal_mulai', 'tanggal_selesai', 'status_surat')->get();
        return view('dashboard.surat_kp.index', compact('surats'));
    }

    public function showForm()
    {
        return view('dashboard.surat_kp.create');
    }

    public function store(SuratKpRequest $request)
    {
        $data = $request->validated();

        // Simpan data ke database
        SuratKP::create($data);

        return redirect()->route('surat-kp.index')->with('success', 'Surat KP berhasil dibuat');
    }

    public function showNomorSuratForm($id)
    {
        $surat = SuratKP::findOrFail($id);
        return view('dashboard.surat_kp.show_nomor_surat', compact('surat'));
    }

    public function updateNomorSurat(NomorSuratKpUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $surat = SuratKP::findOrFail($id);
        $surat->update($data);

        return redirect()->route('surat-kp.index')->with('success', 'Nomor surat berhasil divalidasi');
    }

    public function showPDF($id)
    {
        $surat = SuratKP::findOrFail($id);
        $currentDate = now()->format('d F Y');
        $formatTanggalMulai = date('d F', strtotime($surat->tanggal_mulai));
        $formatTanggalSelesai = date('d F Y', strtotime($surat->tanggal_selesai));
        $pdf = Pdf::loadView('dashboard.surat_kp.pdf', compact('surat', 'currentDate', 'formatTanggalMulai', 'formatTanggalSelesai'));
        return $pdf->stream('surat_kp.pdf');
    }

    public function showBerkasKp()
    {
        // Daftar file yang diizinkan
        $files = ['surat_kp.pdf', 'proposal_kp.pdf', 'file_lain.pdf'];

        // Generate Signed URL untuk setiap file dengan aksi preview atau download
        $signedUrls = [];
        foreach ($files as $file) {
            $signedUrls[$file] = [
                'preview' => URL::signedRoute('pdf.handle', ['file' => $file, 'action' => 'preview']),
                'download' => URL::signedRoute('pdf.handle', ['file' => $file, 'action' => 'download']),
            ];
        }

        return view('dashboard.surat_kp.berkas', compact('signedUrls'));
    }

    public function handleFile($file, $action)
    {
        // Daftar file yang diizinkan
        $allowedFiles = ['surat_kp.pdf', 'proposal_kp.pdf', 'file_lain.pdf'];

        // Cek apakah file yang diminta ada dalam daftar yang diizinkan
        if (!in_array($file, $allowedFiles)) {
            abort(403, 'File tidak diizinkan.');
        }

        // Menggunakan storage_path untuk menentukan lokasi file
        $filePath = storage_path('app/public/berkas-pdf/' . $file);

        // Cek apakah file ada di server
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Tentukan aksi yang akan dilakukan (preview atau download)
        if ($action == 'preview') {
            // Preview file (tampilkan di browser)
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
            ]);
        } elseif ($action == 'download') {
            // Download file
            return response()->download($filePath);
        }

        // Jika aksi tidak dikenal, berikan error
        abort(400, 'Aksi tidak valid.');
    }
}
