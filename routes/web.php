<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')->name('default');

Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->middleware(['permission:dashboard'])->name('dashboard');

    // Route Mahasiswa Profile
    Route::group(['middleware' => ['role:mahasiswa']], function () {
        Route::get('/profile/mahasiswa', [\App\Http\Controllers\Profile\MahasiswaProfileController::class, 'show'])
            ->name('profile.mahasiswa');
        Route::get('/profile/mahasiswa/edit', [\App\Http\Controllers\Profile\MahasiswaProfileController::class, 'edit'])
            ->name('profile.mahasiswa.edit');
        Route::put('/profile/mahasiswa/photo', [\App\Http\Controllers\Profile\MahasiswaProfileController::class, 'updateProfile'])
            ->name('profile.mahasiswa.update-photo');
        Route::put('/profile/mahasiswa/update-password', [\App\Http\Controllers\Profile\MahasiswaProfileController::class, 'updatePassword'])
            ->name('profile.mahasiswa.update-password');
        Route::put('/profile/mahasiswa/update', [\App\Http\Controllers\Profile\MahasiswaProfileController::class, 'updateMahasiswa'])
            ->name('profile.mahasiswa.update');
        Route::put('/profile/mahasiswa/keahlian/{mahasiswaId}', [\App\Http\Controllers\Profile\MahasiswaProfileController::class, 'updateKeahlian'])
            ->name('profile.mahasiswa.update-keahlian');
    });

    // Route Perusahaan Profile
    Route::group(['middleware' => ['role:perusahaan']], function () {
        Route::get('/profile/perusahaan', [\App\Http\Controllers\Profile\PerusahaanProfileController::class, 'show'])
            ->name('profile.perusahaan');
        Route::get('/profile/perusahaan/edit', [\App\Http\Controllers\Profile\PerusahaanProfileController::class, 'edit'])
            ->name('profile.perusahaan.edit');
        Route::put('/profile/perusahaan/photo', [\App\Http\Controllers\Profile\PerusahaanProfileController::class, 'updateProfile'])
            ->name('profile.perusahaan.update-photo');
        Route::put('/profile/perusahaan/update-password', [\App\Http\Controllers\Profile\PerusahaanProfileController::class, 'updatePassword'])
            ->name('profile.perusahaan.update-password');
        Route::put('/profile/perusahaan/update', [\App\Http\Controllers\Profile\PerusahaanProfileController::class, 'updatePerusahaan'])
            ->name('profile.perusahaan.update');
    });

    // Route Surat KP
    Route::group(['middleware' => ['permission:data.surat.kp']], function () {
        Route::get('/surat-kp', [\App\Http\Controllers\Admin\SuratKPController::class, 'index'])
        ->name('surat-kp.index');
    });
    Route::group(['middleware' => ['permission:ajukan.surat.kp']], function () {
        Route::get('/surat-kp/create', [\App\Http\Controllers\Admin\SuratKPController::class, 'showForm'])
        ->name('surat-kp.create');
        Route::post('/surat-kp', [\App\Http\Controllers\Admin\SuratKPController::class, 'store'])
            ->name('surat-kp.store');
    });
    Route::group(['middleware' => ['permission:validasi.surat.kp']], function () {
        Route::get('/surat-kp/{id}/nomor-surat', [\App\Http\Controllers\Admin\SuratKPController::class, 'showNomorSuratForm'])
            ->name('surat-kp.show_form');
        Route::put('/surat-kp/{id}/nomor-surat', [\App\Http\Controllers\Admin\SuratKPController::class, 'updateNomorSurat'])
            ->name('surat-kp.update_surat');
    });
    Route::group(['middleware' => ['permission:berkas.kp']], function () {
        Route::get('/surat-kp/{id}/pdf', [\App\Http\Controllers\Admin\SuratKPController::class, 'showPDF'])
        ->name('surat-kp.show_pdf');
        Route::get('/berkas-kp', [\App\Http\Controllers\Admin\SuratKPController::class, 'showBerkasKp'])
            ->name('berkas-kp');
        Route::get('download-pdf', [\App\Http\Controllers\Admin\SuratKPController::class, 'downloadPDF'])
            ->name('download.pdf');
        Route::get('preview-pdf', [\App\Http\Controllers\Admin\SuratKPController::class, 'previewPDF'])
            ->name('preview.pdf');
        Route::get('/pdf/handle/{file}/{action}', [\App\Http\Controllers\Admin\SuratKPController::class, 'handleFile'])
            ->name('pdf.handle')
            ->middleware('signed');
    }); 
    Route::group(['middleware' => ['permission:upload.surat.perusahaan']], function () { 
        Route::get('/surat-perusahaan/kp', [\App\Http\Controllers\Admin\SuratKPController::class, 'indexUploadSurat'])
        ->name('surat-perusahaan.kp');
        Route::get('/surat-perusahaan/kp/{id}', [\App\Http\Controllers\Admin\SuratKPController::class, 'showUploadSurat'])
            ->name('surat-perusahaan.kp.show');
        Route::put('/surat-perusahaan/kp/{id}', [\App\Http\Controllers\Admin\SuratKPController::class, 'uploadSurat'])
            ->name('surat-perusahaan.kp.upload');
        Route::get('surat-kp/preview/{id}', [\App\Http\Controllers\Admin\SuratKPController::class, 'previewSuratPerusahaan'])
            ->name('surat-kp.preview');
    });
    Route::group(['middleware' => ['permission:status.mahasiswa']], function () { 
        Route::get('surat-kp/status-mahasiswa', [\App\Http\Controllers\Admin\SuratKPController::class, 'showStatus'])
        ->name('surat-kp.status-mahasiswa');
    });

    // Route Lowongan Magang
    Route::get('/lowongan-magang', [\App\Http\Controllers\Admin\LowonganMagangController::class, 'index'])
        ->name('lowongan-magang.index');
    Route::group(['middleware' => ['permission:tambah.lowongan.magang']], function () { 
        Route::get('/lowongan-magang/create', [\App\Http\Controllers\Admin\LowonganMagangController::class, 'create'])
        ->name('lowongan-magang.create');
        Route::post('/lowongan-magang', [\App\Http\Controllers\Admin\LowonganMagangController::class, 'store'])
            ->name('lowongan-magang.store');
    });

    // Route get Mahasiswa and Perusahaan by Id
    Route::get('/mahasiswa/{id}', [\App\Http\Controllers\Profile\MahasiswaProfileController::class, 'showById'])->name('mahasiswa.show');
    Route::get('/perusahaan/{id}', [\App\Http\Controllers\Profile\PerusahaanProfileController::class, 'showById'])->name('perusahaan.show');


    // Route Data Master
    Route::group(['middleware' => ['permission:data.master']], function () {
         // Route Angkatan
        Route::get('/angkatan', [\App\Http\Controllers\Admin\AngkatanController::class, 'index'])
        ->name('angkatan.index');
        Route::post('/angkatan', [\App\Http\Controllers\Admin\AngkatanController::class, 'store'])
            ->name('angkatan.store');
        Route::get('/angkatan/{id}/edit', [\App\Http\Controllers\Admin\AngkatanController::class, 'edit'])
            ->name('angkatan.edit');
        Route::put('/angkatan/{id}', [\App\Http\Controllers\Admin\AngkatanController::class, 'update'])
            ->name('angkatan.update');
        Route::delete('/angkatan/{id}', [\App\Http\Controllers\Admin\AngkatanController::class, 'destroy'])
            ->name('angkatan.destroy');

        // Route Prodi
        Route::get('/prodi', [\App\Http\Controllers\Admin\ProdiController::class, 'index'])
            ->name('prodi.index');
        Route::post('/prodi', [\App\Http\Controllers\Admin\ProdiController::class, 'store'])
            ->name('prodi.store');
        Route::get('/prodi/{id}/edit', [\App\Http\Controllers\Admin\ProdiController::class, 'edit'])
            ->name('prodi.edit');
        Route::put('/prodi/{id}', [\App\Http\Controllers\Admin\ProdiController::class, 'update'])
            ->name('prodi.update');
        Route::delete('/prodi/{id}', [\App\Http\Controllers\Admin\ProdiController::class, 'destroy'])
            ->name('prodi.destroy');

        // Route Keahlian
        Route::get('/keahlian', [\App\Http\Controllers\Admin\KeahlianController::class, 'index'])
            ->name('keahlian.index');
        Route::post('/keahlian', [\App\Http\Controllers\Admin\KeahlianController::class, 'store'])
            ->name('keahlian.store');
        Route::get('/keahlian/{id}/edit', [\App\Http\Controllers\Admin\KeahlianController::class, 'edit'])
            ->name('keahlian.edit');
        Route::put('/keahlian/{id}', [\App\Http\Controllers\Admin\KeahlianController::class, 'update'])
            ->name('keahlian.update');
        Route::delete('/keahlian/{id}', [\App\Http\Controllers\Admin\KeahlianController::class, 'destroy'])
            ->name('keahlian.destroy');

        // Route Lokasi
        Route::get('/lokasi', [\App\Http\Controllers\Admin\LokasiController::class, 'index'])
            ->name('lokasi.index');
        Route::post('/lokasi', [\App\Http\Controllers\Admin\LokasiController::class, 'store'])
            ->name('lokasi.store');
        Route::get('/lokasi/{id}/edit', [\App\Http\Controllers\Admin\LokasiController::class, 'edit'])
            ->name('lokasi.edit');
        Route::put('/lokasi/{id}', [\App\Http\Controllers\Admin\LokasiController::class, 'update'])
            ->name('lokasi.update');
        Route::delete('/lokasi/{id}', [\App\Http\Controllers\Admin\LokasiController::class, 'destroy'])
            ->name('lokasi.destroy');
    }); 

    // Route Pengguna
    Route::group(['middleware' => ['permission:pengguna']], function () {
        Route::get('/pengguna/create', [\App\Http\Controllers\Admin\PenggunaController::class, 'create'])
            ->name('pengguna.create');
        Route::post('/pengguna', [\App\Http\Controllers\Admin\PenggunaController::class, 'store'])
            ->name('pengguna.store'); 
    });

    // Route Pembimbing KP
    Route::get('/pembimbing-kp', [\App\Http\Controllers\Admin\PembimbingKPController::class, 'index'])
        ->name('pembimbing.index');
    Route::get('/pembimbing-kp/create', [\App\Http\Controllers\Admin\PembimbingKPController::class, 'create'])
        ->name('pembimbing.create');
    Route::post('/pembimbing-kp', [\App\Http\Controllers\Admin\PembimbingKPController::class, 'store'])
        ->name('pembimbing.store');
    Route::get('/pembimbing-kp/{id}/edit', [\App\Http\Controllers\Admin\PembimbingKPController::class, 'edit'])
        ->name('pembimbing.edit');
    Route::put('/pembimbing-kp/{id}', [\App\Http\Controllers\Admin\PembimbingKPController::class, 'update'])
        ->name('pembimbing.update');
    Route::delete('/pembimbing-kp/{id}', [\App\Http\Controllers\Admin\PembimbingKPController::class, 'destroy'])
        ->name('pembimbing.destroy');


    // Route Mahasiswa
    Route::resource('mahasiswa', \App\Http\Controllers\Admin\MahasiswaController::class);

    // Route Perusahaan
    Route::resource('perusahaan', \App\Http\Controllers\Admin\PerusahaanController::class);

    // Route riwayat magang
    Route::get('/riwayat-magang/mahasiswa', [\App\Http\Controllers\Admin\RiwayatMagangController::class, 'riwayatShow'])
        ->name('riwayat-magang.mahasiswa');
    Route::group(['middleware' => ['permission:tambah.riwayat.magang.mahasiswa']], function () {
        Route::get('/riwayat-magang/mahasiswa/create', [\App\Http\Controllers\Admin\RiwayatMagangController::class, 'riwayatCreateMahasiswa'])
        ->name('riwayat-magang.create.mahasiswas');
        Route::post('/riwayat-magang/mahasiswa/store', [\App\Http\Controllers\Admin\RiwayatMagangController::class, 'riwayatStoreMahasiswa'])
            ->name('riwayat-magang.store.mahasiswa');
    });
    Route::group(['middleware' => ['permission:data.riwayat.magang']], function () { 
        Route::get('/riwayat-magang', [\App\Http\Controllers\Admin\RiwayatMagangController::class, 'index'])->name('riwayat-magang.index');
        Route::get('/riwayat-magang/{id}/edit', [\App\Http\Controllers\Admin\RiwayatMagangController::class, 'edit'])->name('riwayat-magang.edit');
        Route::put('/riwayat-magang/{id}', [\App\Http\Controllers\Admin\RiwayatMagangController::class, 'update'])->name('riwayat-magang.update');
        Route::delete('/riwayat-magang/{id}', [\App\Http\Controllers\Admin\RiwayatMagangController::class, 'destroy'])->name('riwayat-magang.destroy');
    });
    Route::group(['middleware' => ['permission:tambah.riwayat.magang']], function () {
        Route::get('/riwayat-magang/create', [\App\Http\Controllers\Admin\RiwayatMagangController::class, 'create'])->name('riwayat-magang.create');
        Route::post('/riwayat-magang', [\App\Http\Controllers\Admin\RiwayatMagangController::class, 'store'])->name('riwayat-magang.store');    
    }); 

    // Route roles permissions management
    Route::group(['middleware' => ['permission:permission|roles']], function () {
        Route::resource('permissions', \App\Http\Controllers\RolePermission\PermissionController::class);
        Route::resource('roles', \App\Http\Controllers\RolePermission\RoleController::class);
        // Extra Route Roles and Permissions
        Route::get('/role-assignment', [\App\Http\Controllers\RolePermission\RoleController::class, 'showForm'])->name('role-assignment.form');
        Route::post('/role-assignment', [\App\Http\Controllers\RolePermission\RoleController::class, 'assignRole'])->name('role-assignment.assign');
        Route::get('roles/{role}/permissions', [\App\Http\Controllers\RolePermission\RoleController::class, 'edit'])->name('roles.permissions.edit');
        Route::put('roles/{role}/permissions', [\App\Http\Controllers\RolePermission\RoleController::class, 'update'])->name('roles.permissions.update');
    });
});

Route::get('/test-pdf', function (){
    return view('dashboard.surat_kp.pdf');
});

Route::get('/dashboard2', function () {
    return view('dashboard.layouts.main');
})->middleware(['auth', 'verified'])->name('dashboard2');

require __DIR__.'/auth.php';
