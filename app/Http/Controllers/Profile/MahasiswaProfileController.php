<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\MahasiswaProfileUpdateRequest;
use App\Http\Requests\Profile\MahasiswaDetailsUpdateRequest;
use App\Models\Keahlian;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;

class MahasiswaProfileController extends Controller
{
    private $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function show(Request $request)
    {
        $user = $request->user();
        $mahasiswa = $user->mahasiswa;
        $riwayatMagang = $request->user()->riwayatMagang()->where('mahasiswa_id', $user->id)->get();
        return view('dashboard.mahasiswa.profile', ['mahasiswa' => $mahasiswa, 'riwayatMagang' => $riwayatMagang]);
    }

    public function edit(Request $request)
    {
        $mahasiswa = $request->user()->mahasiswa;
        $keahlians = Keahlian::query()->select('id', 'nama_keahlian')->get();
        return view('dashboard.mahasiswa.profile-edit', ['mahasiswa' => $mahasiswa, 'keahlians' => $keahlians]);
    }

    public function updateKeahlian(Request $request, $mahasiswaId)
    {
        $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);
        $keahlianIds = $request->keahlian_id;

        if (count($keahlianIds) > 10) {
            return redirect()->back()->withErrors(['error' => 'Mahasiswa hanya boleh memiliki maksimal 10 keahlian.']);
        }

        $mahasiswa->keahlian()->sync($keahlianIds);
        return redirect()->route('profile.mahasiswa.edit')->with('success', 'Keahlian updated successfully.');
    }

    public function updateProfile(MahasiswaProfileUpdateRequest $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $profile = $request->validated();

        if ($request->hasFile('photo')) {
            $currentPhoto = $mahasiswa ? $mahasiswa->photo : null;
            $profile['photo'] = $this->profileService->handleFileUploadMahasiswa($request->file('photo'), $currentPhoto);
        }

        $mahasiswa->update($profile);
        return redirect()->route('profile.mahasiswa.edit')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::findOrFail(auth()->id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile.mahasiswa.edit')->with('success', 'Password updated successfully.');
    }

    public function updateMahasiswa(MahasiswaDetailsUpdateRequest $request)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        $validated = $request->validated();

        DB::transaction(function () use ($user, $mahasiswa, $validated, $request) {
            User::where('id', $user->id)->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'nip_nrp' => $validated['nrp'],
            ]);

            $mahasiswaData = [
                'deskripsi' => $validated['deskripsi'],
            ];

            $mahasiswa->update($mahasiswaData);
        });

        // Clear cache after update
        Cache::forget('mahasiswa_profile_' . auth()->id());

        return redirect()->route('profile.mahasiswa.edit')->with('success', 'Profile updated successfully.');
    }

    public function showById($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('dashboard.mahasiswa.show', compact('mahasiswa'));
    }
}
