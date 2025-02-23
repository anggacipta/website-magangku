<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RiwayatMagangMahasiswaRequest;
use App\Http\Requests\RiwayatMagangRequest;
use App\Http\Requests\RiwayatMagangUpdateRequest;
use App\Models\Angkatan;
use App\Models\Prodi;
use App\Models\RiwayatMagang;
use App\Models\User;
use App\Services\FotoKegiatanService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RiwayatMagangController extends Controller
{
    private $fotoService;

    public function __construct(FotoKegiatanService $fotoService)
    {
        $this->fotoService = $fotoService;
    }

    public function index()
    {
        $riwayats = RiwayatMagang::query()
            ->with('user')
            ->get();
        return view('dashboard.riwayat_magang.index', compact('riwayats'));
    }

    public function create()
    {
        $mahasiswas = User::role('mahasiswa')->doesntHave('riwayatMagang')->get();
        return view('dashboard.riwayat_magang.create', compact('mahasiswas'));
    }

    public function store(RiwayatMagangRequest $request)
    {
        // Validate the request
        $data = $request->validated();

        // Convert 'tahun_pengadaan' to 'YYYY-MM-DD' format
        $data['tanggal_mulai'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_mulai)->format('Y-m-d');
        $data['tanggal_selesai'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_selesai)->format('Y-m-d');

        RiwayatMagang::create($data);
        return redirect()->route('riwayat-magang.index')->with('success', 'Riwayat magang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $riwayat = RiwayatMagang::findOrFail($id);
        return view('dashboard.riwayat_magang.edit', compact('riwayat'));
    }

    public function update(RiwayatMagangUpdateRequest $request, $id)
    {
        // Validate the request
        $data = $request->validated();

        // Convert 'tahun_pengadaan' to 'YYYY-MM-DD' format
        $data['tanggal_mulai'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_mulai)->format('Y-m-d');
        $data['tanggal_selesai'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_selesai)->format('Y-m-d');

        RiwayatMagang::findOrFail($id)->update($data);
        return redirect()->route('riwayat-magang.index');
    }

    public function destroy($id)
    {
        RiwayatMagang::findOrFail($id)->delete();
        return redirect()->route('riwayat-magang.index');
    }

    public function riwayatShow(Request $request)
    {
        $angkatanList = Angkatan::query()->select('tahun_angkatan')->get();
        $prodiList = Prodi::query()->select('nama_prodi')->get();

        $query = RiwayatMagang::query()->with('user.mahasiswa');

        if ($request->filled('angkatan')) {
            $query->whereHas('user.mahasiswa.angkatan', function ($q) use ($request) {
                $q->where('tahun_angkatan', $request->angkatan);
            });
        }

        if ($request->filled('prodi')) {
            $query->whereHas('user.mahasiswa.prodi', function ($q) use ($request) {
                $q->where('nama_prodi', $request->prodi);
            });
        }

        $riwayats = $query->get();

        return view('dashboard.riwayat_magang.riwayat', compact('riwayats', 'angkatanList', 'prodiList'));
    }

    public function riwayatCreateMahasiswa()
    {
        return view('dashboard.riwayat_magang.create_riwayat_mahasiswa');
    }

    public function riwayatStoreMahasiswa(RiwayatMagangMahasiswaRequest $request)
    {
        $user = auth()->user();

        // Check if the user has the 'mahasiswa' role
        if (!$user->hasRole('mahasiswa')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menambahkan riwayat magang.');
        }

        $data = $request->validated();

        if ($request->hasFile('foto_kegiatan')) {
            $data['foto_kegiatan'] = $this->fotoService->handleFileUpload($request->file('foto_kegiatan'));
        }

        $data['mahasiswa_id'] = $user->id ?? $user->mahasiswa_id;
        // Convert 'tahun_pengadaan' to 'YYYY-MM-DD' format
        $data['tanggal_mulai'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_mulai)->format('Y-m-d');
        $data['tanggal_selesai'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_selesai)->format('Y-m-d');

        RiwayatMagang::create($data);
        return redirect()->route('riwayat-magang.mahasiswa')->with('success', 'Riwayat magang berhasil ditambahkan');
    }
}
