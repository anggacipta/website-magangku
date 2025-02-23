<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LokasiRequest;
use App\Http\Requests\LokasiUpdateRequest;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Lokasi::query()->select('id', 'nama_lokasi')->get();
        return view('dashboard.lokasi.index', compact('lokasis'));
    }

    public function store(LokasiRequest $request)
    {
        $request->validated();

        Lokasi::create([
            'nama_lokasi' => $request->nama_lokasi,
        ]);

        return redirect()->route('lokasi.index')
            ->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $lokasi = Lokasi::find($id);
        return view('dashboard.lokasi.edit', compact('lokasi'));
    }

    public function update(LokasiUpdateRequest $request, $id)
    {
        $request->validated();

        $lokasi = Lokasi::find($id);

        if ($lokasi) {
            // Check if the input value is the same as the current value in the database
            if ($lokasi->nama_lokasi === $request->nama_lokasi) {
                return redirect()->route('lokasi.index')
                    ->with('info', 'Tidak ada perubahan data');
            }

            $lokasi->update([
                'nama_lokasi' => $request->nama_lokasi,
            ]);
        } else {
            return redirect()->route('lokasi.index')
                ->with('error', 'Lokasi tidak ditemukan');
        }

        return redirect()->route('lokasi.index')
            ->with('success', 'Lokasi berhasil diupdate');
    }

    public function destroy($id)
    {
        $lokasi = Lokasi::find($id);

        if ($lokasi) {
            $lokasi->delete();
        } else {
            return redirect()->route('lokasi.index')
                ->with('error', 'Lokasi tidak ditemukan');
        }

        return redirect()->route('lokasi.index')
            ->with('error', 'Lokasi berhasil dihapus');
    }
}
