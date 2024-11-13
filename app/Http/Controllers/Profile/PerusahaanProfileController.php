<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\PerusahaanDetailsUpdateRequest;
use App\Http\Requests\Profile\MahasiswaProfileUpdateRequest;
use App\Models\Perusahaan;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class PerusahaanProfileController extends Controller
{
    private $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function show(Request $request)
    {
        $perusahaan = $request->user()->perusahaan;
        return view('dashboard.perusahaan.profile', ['perusahaan' => $perusahaan]);
    }

    public function edit(Request $request)
    {
        $perusahaan = $request->user()->perusahaan;
        return view('dashboard.perusahaan.profile-edit', ['perusahaan' => $perusahaan]);
    }

    public function updateProfile(MahasiswaProfileUpdateRequest $request)
    {
        $perusahaan = auth()->user()->perusahaan;
        $profile = $request->validated();

        if ($request->hasFile('photo')) {
            $currentPhoto = $perusahaan ? $perusahaan->photo : null;
            $profile['photo'] = $this->profileService->handleFileUploadPerusahaan($request->file('photo'), $currentPhoto);
        }

        if ($perusahaan) {
            $perusahaan->update($profile);
        } else {
            // Handle the case where $this->perusahaan is null
            return redirect()->route('profile.perusahaan.edit')->with('error', 'Perusahaan not found.');
        }
        return redirect()->route('profile.perusahaan.edit')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile.perusahaan.edit')->with('success', 'Password updated successfully.');
    }

    public function updatePerusahaan(PerusahaanDetailsUpdateRequest $request)
    {
        $user = auth()->user();
        $perusahaan = $user->perusahaan;
        $validated = $request->validated();

        DB::transaction(function () use ($user, $perusahaan, $validated, $request) {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            $perusahaanData = [
                'deskripsi' => $validated['deskripsi'],
            ];

            $perusahaan->update($perusahaanData);
        });

        // Clear cache after update
        Cache::forget('perusahaan_profile_' . auth()->id());

        return redirect()->route('profile.perusahaan.edit')->with('success', 'Profile updated successfully.');
    }

    public function showById($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('dashboard.perusahaan.show', compact('perusahaan'));
    }
}
