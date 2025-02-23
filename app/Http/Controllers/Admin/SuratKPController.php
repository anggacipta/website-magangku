<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NomorSuratKpUpdateRequest;
use App\Http\Requests\SuratKpRequest;
use App\Http\Requests\UploadSuratPerusahaanRequest;
use App\Models\Angkatan;
use App\Models\Prodi;
use App\Models\SuratKP;
use App\Services\UploadSuratPerusahaanService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SuratKPController extends Controller
{
    private $uploadService;

    public function __construct(UploadSuratPerusahaanService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function index()
    {
        $surats = SuratKP::select('id', 'nama_perusahaan', 'tanggal_mulai', 'tanggal_selesai', 'status_surat', 'mahasiswa_id')->get();
        $user = auth()->user();

        if ($user->hasRole('mahasiswa')) {
            $surats = $surats->where('mahasiswa_id', $user->mahasiswa_id);
        } elseif ($user->hasRole('pembimbing_kp')) {
            // Do nothing, show all data
        } else {
            $surats = collect(); // Empty collection
            return view('dashboard.surat_kp.index', compact('surats'))->with('error', 'Anda tidak memiliki akses untuk melihat data ini.');
        }
        return view('dashboard.surat_kp.index', compact('surats'));
    }

    public function showForm()
    {
        return view('dashboard.surat_kp.create');
    }

    public function store(SuratKpRequest $request)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        // Check if the student has submitted the surat_perusahaan
        $existingSuratKP = SuratKP::where('mahasiswa_id', $mahasiswa->id)
            ->whereIn('status_surat', [1, 2])
            ->first();

        if ($existingSuratKP && !$existingSuratKP->upload_surat) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengajukan surat KP baru sebelum validasi dan mengumpulkan surat perusahaan.');
        }

        $data = $request->validated();

        $data['mahasiswa_id'] = auth()->user()->mahasiswa_id ?? auth()->user()->id;

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
        $currentDate = Carbon::now()->locale('id')->translatedFormat('d F Y');
        $formatTanggalMulai = Carbon::parse($surat->tanggal_mulai)->locale('id')->translatedFormat('d F Y');
        $formatTanggalSelesai = Carbon::parse($surat->tanggal_selesai)->locale('id')->translatedFormat('d F Y');
        $pdf = Pdf::loadView('dashboard.surat_kp.pdf', compact('surat', 'currentDate', 'formatTanggalMulai', 'formatTanggalSelesai'));
        return $pdf->stream('surat_kp.pdf');
    }

    public function showBerkasKp()
    {
        // Daftar file yang diizinkan
        $files = ['surat_kp.pdf', 'proposal_kp.pdf', 'cv-ats.docx'];

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
        $allowedFiles = ['surat_kp.pdf', 'proposal_kp.pdf', 'cv-ats.docx'];

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

    public function indexUploadSurat()
    {
        $surats = SuratKP::select('id', 'nama_perusahaan', 'tanggal_mulai', 'tanggal_selesai', 'status_surat', 'mahasiswa_id')->get();
        $user = auth()->user();
        if ($user->hasRole('mahasiswa')) {
            $surats = $surats->where('mahasiswa_id', $user->mahasiswa_id);
        } elseif ($user->hasRole('pembimbing_kp')) {
            // Do nothing, show all data
        } else {
            $surats = collect(); // Empty collection
            return view('dashboard.surat_kp.index', compact('surats'))->with('error', 'Anda tidak memiliki akses untuk melihat data ini.');
        }
        return view('dashboard.surat_kp.index_upload_surat', compact('surats'));
    }

    public function showUploadSurat($id)
    {
        $surat = SuratKP::findOrFail($id);
        return view('dashboard.surat_kp.show_upload_surat', compact('surat'));
    }

    public function uploadSurat(UploadSuratPerusahaanRequest $request, $id)
    {
        $surat = SuratKP::findOrFail($id);
        $currentFile = $surat ? $surat->upload_surat : null;
        $newFile = $request->file('upload_surat');
        $suratUpdate = $request->validated();

        $suratUpdate['upload_surat'] = $this->uploadService->handleFileUploadSuratPerusahaan($newFile, $currentFile);
        $surat->update($suratUpdate);

        return redirect()->route('surat-perusahaan.kp')->with('success', 'Surat perusahaan berhasil diunggah');
    }

    public function previewSuratPerusahaan($id)
    {
        $surat = SuratKP::findOrFail($id);

        if (!$surat->upload_surat) {
            return redirect()->back()->with('error', 'No PDF file found.');
        }

        $filePath = storage_path('app/public/surat_perusahaan/' . $surat->upload_surat);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function showStatus(Request $request)
    {
        // Fetch all Prodi and Angkatan for the filters
        $prodiList = Prodi::query()->select('nama_prodi')->get();
        $angkatanList = Angkatan::query()->select('tahun_angkatan')->get();

        // Fetch all Surat KP records with the related user and status
        $query = SuratKP::query()->with('mahasiswas');

        if ($request->filled('prodi')) {
            $query->whereHas('mahasiswas.prodi', function ($q) use ($request) {
                $q->where('nama_prodi', $request->prodi);
            });
        }

        if ($request->filled('angkatan')) {
            $query->whereHas('mahasiswas.angkatan', function ($q) use ($request) {
                $q->where('tahun_angkatan', $request->angkatan);
            });
        }

        $suratKPs = $query->get()->groupBy('mahasiswa_id');

        return view('dashboard.surat_kp.status', compact('suratKPs', 'prodiList', 'angkatanList'));
    }

}
