<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratKP;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'nama_perusahaan' => 'required|string',
            'alamat_perusahaan' => 'required|string',
            'mahasiswa' => 'required|array',
            'mahasiswa.*.nama' => 'required|string',
            'status_surat' => 'nullable|numeric',
        ]);

        // Simpan data ke database
        SuratKP::create($data);

        return redirect()->route('surat-kp.index')->with('success', 'Surat KP berhasil dibuat');
    }

    public function showNomorSuratForm($id)
    {
        $surat = SuratKP::findOrFail($id);
        return view('dashboard.surat_kp.show_nomor_surat', compact('surat'));
    }

    public function updateNomorSurat(Request $request, $id)
    {
        $data = $request->validate([
            'nomor_surat' => 'required|string',
            'status_surat' => 'required|numeric',
        ]);

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
}
