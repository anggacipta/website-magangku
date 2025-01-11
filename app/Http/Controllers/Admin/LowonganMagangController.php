<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LowonganMagang;
use Illuminate\Http\Request;

class LowonganMagangController extends Controller
{
    public function index()
    {
        $lowonganMagangs = LowonganMagang::with('pelamars.mahasiswa.user')->get();
        return view('dashboard.lowongan_magang.index', compact('lowonganMagangs'));
    }
}
