<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Angkatan;
use App\Models\Mahasiswa;
use App\Models\PembimbingKP;
use App\Models\Prodi;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $prodis = Prodi::query()->select('id', 'nama_prodi')->get();
        $angkatans = Angkatan::query()->select('id', 'tahun_angkatan')->get();
        $pembimbings = PembimbingKP::with('user')->get();
        return view('auth.register', compact('prodis', 'angkatans', 'pembimbings'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'nip_nrp' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'pembimbing' => ['required', 'numeric'],
            'angkatan' => ['required', 'numeric'],
            'prodi' => ['required', 'numeric'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nip_nrp.required' => 'NRP wajib diisi.',
            'nip_nrp.unique' => 'NRP sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'pembimbing.required' => 'Pembimbing wajib dipilih.',
            'angkatan.required' => 'Angkatan wajib dipilih.',
            'prodi.required' => 'Prodi wajib dipilih.',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nip_nrp' => $request->nip_nrp,
                'password' => Hash::make($request->password),
            ]);

            // Assign role mahasiswa
            $user->assignRole('mahasiswa');

            // Create a new Mahasiswa record
            $mahasiswa = Mahasiswa::create([
                'id' => $user->id,
                'prodi_id' => $request->prodi,
                'angkatan_id' => $request->angkatan,
                'pembimbing_id' => $request->pembimbing,
            ]);

            // Update the user with the mahasiswa_id
            $user->update(['mahasiswa_id' => $mahasiswa->id]);

            event(new Registered($user));

            Auth::login($user);
        });

        return redirect()->route('dashboard');
    }
}
