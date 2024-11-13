<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PerusahaanRequest;
use App\Http\Requests\PerusahaanUpdateRequest;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PerusahaanController extends Controller
{
    public function index()
    {
        $users = User::role('perusahaan')->get();
        return view('dashboard.perusahaan.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.perusahaan.create');
    }

    public function store(PerusahaanRequest $request)
    {
        $request->validated();

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Assign role perusahaan role
            $user->assignRole('perusahaan');

            // Create new Mahasiswa record
            $perusahaan = Perusahaan::create([
                'id' => $user->id,
            ]);

            // Update the user record with the Mahasiswa id
            $user->update([
                'perusahaan_id' => $perusahaan->id,
            ]);
        });

        return redirect()->route('perusahaan.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.perusahaan.edit', compact('user'));
    }

    public function update(PerusahaanUpdateRequest $request, $id)
    {
        $request->validated();

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('perusahaan.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete the related Mahasiswa record
        if ($user->perusahaan) {
            $user->perusahaan->delete();
        }

        // Delete the related RiwayatMagang records
        if ($user->riwayatMagang) {
            $user->riwayatMagang->delete();
        }

        // Delete the user record
        $user->delete();

        return redirect()->route('perusahaan.index')->with('error', 'User deleted successfully.');
    }
}
