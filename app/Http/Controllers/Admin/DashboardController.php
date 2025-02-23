<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\RiwayatMagang;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the count of users with the role 'mahasiswa'
        $mahasiswaCount = Role::where('name', 'mahasiswa')->first()->users()->count();
        $pembimbingCount = Role::where('name', 'pembimbing_kp')->first()->users()->count();
        $perusahaanCount = Role::where('name', 'perusahaan')->first()->users()->count();
        
        // Fetch the count of riwayatMagang records
        $riwayatMagangCount = RiwayatMagang::count();

        return view('dashboard.dashboard', compact('mahasiswaCount', 'pembimbingCount', 'perusahaanCount', 'riwayatMagangCount'));
    }
}