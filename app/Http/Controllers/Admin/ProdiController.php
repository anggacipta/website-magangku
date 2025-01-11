<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdiRequest;
use App\Http\Requests\ProdiUpdateRequest;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::query()->select('id', 'nama_prodi')->get();
        return view('dashboard.prodi.index', compact('prodis'));
    }

    public function store(ProdiRequest $request)
    {
        $request->validated();

        Prodi::create([
            'nama_prodi' => $request->nama_prodi,
        ]);

        return redirect()->route('prodi.index')
            ->with('success', 'Prodi berhasil ditambahkan ditambahkan');
    }

    public function edit($id)
    {
        $prodi = Prodi::find($id);
        return view('dashboard.prodi.edit', compact('prodi'));
    }

    public function update(ProdiUpdateRequest $request, $id)
    {
        $request->validated();

        $prodi = Prodi::find($id);

        if ($prodi) {
            // Check if the input value is the same as the current value in the database
            if ($prodi->nama_prodi === $request->nama_prodi) {
                return redirect()->route('prodi.index')
                    ->with('info', 'Tidak ada perubahan data');
            }

            $prodi->update([
                'nama_prodi' => $request->nama_prodi,
            ]);
        } else {
            return redirect()->route('prodi.index')
                ->with('error', 'Prodi tidak ditemukan');
        }

        return redirect()->route('prodi.index')
            ->with('success', 'Angkatan berhasil diupdate');
    }

    public function destroy($id)
    {
        $prodi = Prodi::find($id);

        if ($prodi) {
            $prodi->delete();
        } else {
            return redirect()->route('prodi.index')
                ->with('error', 'Prodi tidak ditemukan');
        }

        return redirect()->route('prodi.index')
            ->with('success', 'Prodi berhasil dihapus');
    }
}
