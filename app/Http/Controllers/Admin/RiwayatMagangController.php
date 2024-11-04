<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RiwayatMagangRequest;
use App\Http\Requests\RiwayatMagangUpdateRequest;
use App\Models\RiwayatMagang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RiwayatMagangController extends Controller
{
    public function index()
    {
        $riwayats = RiwayatMagang::all();
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
}
