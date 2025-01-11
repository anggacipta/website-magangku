<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PembimbingKPRequest;
use App\Http\Requests\PembimbingKPUpdateRequest;
use App\Models\PembimbingKP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PembimbingKPController extends Controller
{
    public function index()
    {
        $users = User::role('pembimbing_kp')->get();
        return view('dashboard.pembimbing_kp.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.pembimbing_kp.create');
    }

    public function store(PembimbingKPRequest $request)
    {
        $request->validated();

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nip' => $request->nip,
                'password' => Hash::make($request->password),
            ]);

            // Assign role mahasiswa role
            $user->assignRole('pembimbing_kp');

            // Create new Pembimbing record
            $pembimbing = PembimbingKP::create([
                'id' => $user->id,
            ]);

            // Update the user record with the Mahasiswa id
            $user->update([
                'pembimbing_id' => $pembimbing->id,
            ]);
        });

        return redirect()->route('pembimbing.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.pembimbing_kp.edit', compact('user'));
    }

    public function update(PembimbingKPUpdateRequest $request, $id)
    {
        $request->validated();

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('pembimbing.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete the related Mahasiswa record
        if ($user->pembimbingKP) {
            $user->pembimbingKP->delete();
        }

        // Delete the user record
        $user->delete();

        return redirect()->route('pembimbing.index')->with('error', 'User deleted successfully.');
    }
}
