<?php

// app/Http/Controllers/Admin/MahasiswaController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Http\Requests\MahasiswaUpdateRequest;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index()
    {
        $users = User::role('mahasiswa')->get();
        return view('dashboard.mahasiswa.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.mahasiswa.create');
    }

    public function store(MahasiswaRequest $request)
    {
        $request->validated();

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nrp' => $request->nrp,
                'password' => Hash::make($request->password),
            ]);

            // Assign role mahasiswa role
            $user->assignRole('mahasiswa');

            // Create new Mahasiswa record
            $mahasiswa = Mahasiswa::create([
                'id' => $user->id,
            ]);

            // Update the user record with the Mahasiswa id
            $user->update([
                'mahasiswa_id' => $mahasiswa->id,
            ]);
        });

        return redirect()->route('mahasiswa.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.mahasiswa.edit', compact('user'));
    }

    public function update(MahasiswaUpdateRequest $request, $id)
    {
        $request->validated();

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nip_nrp' => $request->nip_nrp,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete the related Mahasiswa record
        if ($user->mahasiswa) {
            $user->mahasiswa->delete();
        }

        // Delete the related RiwayatMagang records
        if ($user->riwayatMagang) {
            $user->riwayatMagang->delete();
        }

        // Delete the user record
        $user->delete();

        return redirect()->route('mahasiswa.index')->with('error', 'User deleted successfully.');
    }
}
