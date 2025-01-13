<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeahlianRequest;
use App\Http\Requests\KeahlianUpdateRequest;
use App\Models\Keahlian;
use Illuminate\Http\Request;

class KeahlianController extends Controller
{
    public function index()
    {
        $keahlians = Keahlian::query()->select('id', 'nama_keahlian')->get();
        return view('dashboard.keahlian.index', compact('keahlians'));
    }

    public function store(KeahlianRequest $request)
    {
        $request->validated();

        Keahlian::create([
            'nama_keahlian' => $request->tahun_angkatan,
        ]);

        return redirect()->route('keahlian.index')
            ->with('success', 'Keahlian berhasil ditambahkan');
    }

    public function edit($id)
    {
        $keahlian = Keahlian::find($id);
        return view('dashboard.keahlian.edit', compact('keahlian'));
    }

    public function update(KeahlianUpdateRequest $request, $id)
    {
        $request->validated();

        $keahlian = Keahlian::find($id);

        if ($keahlian) {
            // Check if the input value is the same as the current value in the database
            if ($keahlian->nama_keahlian === $request->nama_keahlian) {
                return redirect()->route('keahlian.index')
                    ->with('info', 'Tidak ada perubahan data');
            }

            $keahlian->update([
                'nama_keahlian' => $request->nama_keahlian,
            ]);
        } else {
            return redirect()->route('keahlian.index')
                ->with('error', 'Keahlian tidak ditemukan');
        }

        return redirect()->route('keahlian.index')
            ->with('success', 'Keahlian berhasil diupdate');
    }

    public function destroy($id)
    {
        $keahlian = Keahlian::find($id);

        if ($keahlian) {
            $keahlian->delete();
        } else {
            return redirect()->route('keahlian.index')
                ->with('error', 'Keahlian tidak ditemukan');
        }

        return redirect()->route('keahlian.index')
            ->with('success', 'Keahlian berhasil dihapus');
    }
}
