<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AngkatanRequest;
use App\Http\Requests\AngkatanUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Angkatan;

class AngkatanController extends Controller
{
    public function index()
    {
        $angkatans = Angkatan::query()->select('id', 'tahun_angkatan')->get();
        return view('dashboard.angkatan.index', compact('angkatans'));
    }

    public function store(AngkatanRequest $request)
    {
        $request->validated();

        Angkatan::create([
            'tahun_angkatan' => $request->tahun_angkatan,
        ]);

        return redirect()->route('angkatan.index')
            ->with('success', 'Angkatan created successfully');
    }

    public function edit($id)
    {
        $angkatan = Angkatan::find($id);
        return view('dashboard.angkatan.edit', compact('angkatan'));
    }

    public function update(AngkatanUpdateRequest $request, $id)
    {
        $request->validated();

        $angkatan = Angkatan::find($id);

        if ($angkatan) {
            // Check if the input value is the same as the current value in the database
            if ($angkatan->tahun_angkatan === $request->tahun_angkatan) {
                return redirect()->route('angkatan.index')
                    ->with('info', 'Tidak ada perubahan data');
            }

            $angkatan->update([
                'tahun_angkatan' => $request->tahun_angkatan,
            ]);
        } else {
            return redirect()->route('angkatan.index')
                ->with('error', 'Angkatan not found');
        }

        return redirect()->route('angkatan.index')
            ->with('success', 'Angkatan updated successfully');
    }

    public function destroy($id)
    {
        $angkatan = Angkatan::find($id);

        if ($angkatan) {
            $angkatan->delete();
        } else {
            return redirect()->route('angkatan.index')
                ->with('error', 'Angkatan not found');
        }

        return redirect()->route('angkatan.index')
            ->with('error', 'Angkatan deleted successfully');
    }
}
