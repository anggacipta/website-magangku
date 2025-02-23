<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LowonganMagangRequest;
use App\Models\Lokasi;
use App\Models\LowonganMagang;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class LowonganMagangController extends Controller
{
    public function index(Request $request)
    {
        $query = LowonganMagang::query();

        if ($request->filled('nama_pekerjaan')) {
            $query->where('posisi', 'like', '%' . $request->nama_pekerjaan . '%');
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', $request->lokasi);
        }

        $lowonganMagangs = $query->with('pelamars.mahasiswa.user')->get();
        $lokasiList = Lokasi::select('id', 'nama_lokasi')->get();

        return view('dashboard.lowongan_magang.index', compact('lowonganMagangs', 'lokasiList'));
    }
    public function create()
    {
        $lokasiList = Lokasi::select('id', 'nama_lokasi')->get();
        return view('dashboard.lowongan_magang.create', compact('lokasiList'));
    }

    public function store(LowonganMagangRequest $request)
    {
        $data = $request->validated();

        $data['deskripsi'] = Purifier::clean($data['deskripsi']);
        $data['pembuat_id'] = auth()->user()->id;
        LowonganMagang::create($data);
        return redirect()->route('lowongan-magang.index')->with('success', 'Lowongan magang berhasil ditambahkan.');
    }
}
