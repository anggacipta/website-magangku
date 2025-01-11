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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
    Route::get('/surat-kp', [\App\Http\Controllers\Admin\SuratKPController::class, 'index'])
        ->name('surat-kp.index');
    Route::get('/surat-kp/create', [\App\Http\Controllers\Admin\SuratKPController::class, 'showForm'])
        ->name('surat-kp.create');
    Route::post('/surat-kp', [\App\Http\Controllers\Admin\SuratKPController::class, 'store'])
        ->name('surat-kp.store');
    Route::get('/surat-kp/{id}/nomor-surat', [\App\Http\Controllers\Admin\SuratKPController::class, 'showNomorSuratForm'])
        ->name('surat_kp.show_form');
    Route::put('/surat-kp/{id}/nomor-surat', [\App\Http\Controllers\Admin\SuratKPController::class, 'updateNomorSurat'])
        ->name('surat_kp.update_surat');
    Route::get('/surat-kp/{id}/pdf', [\App\Http\Controllers\Admin\SuratKPController::class, 'showPDF'])
        ->name('surat_kp.show_pdf');

    // Route Lowongan Magang
    Route::get('/lowongan-magang', [\App\Http\Controllers\Admin\LowonganMagangController::class, 'index'])
        ->name('lowongan-magang.index');

    // Route get Mahasiswa and Perusahaan by Id
    Route::get('/mahasiswa/{id}', [\App\Http\Controllers\Profile\MahasiswaProfileController::class, 'showById'])->name('mahasiswa.show');
    Route::get('/perusahaan/{id}', [\App\Http\Controllers\Profile\PerusahaanProfileController::class, 'showById'])->name('perusahaan.show');

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

    // Route Mahasiswa
    Route::resource('mahasiswa', \App\Http\Controllers\Admin\MahasiswaController::class);

    // Route Perusahaan
    Route::resource('perusahaan', \App\Http\Controllers\Admin\PerusahaanController::class);

    // Route riwayat magang
    Route::resource('riwayat-magang', \App\Http\Controllers\Admin\RiwayatMagangController::class);

    // Route roles permissions management
    Route::resource('permissions', \App\Http\Controllers\RolePermission\PermissionController::class);
    Route::resource('roles', \App\Http\Controllers\RolePermission\RoleController::class);
    // Extra Route Roles and Permissions
    Route::get('/role-assignment', [\App\Http\Controllers\RolePermission\RoleController::class, 'showForm'])->name('role-assignment.form');
    Route::post('/role-assignment', [\App\Http\Controllers\RolePermission\RoleController::class, 'assignRole'])->name('role-assignment.assign');
    Route::get('roles/{role}/permissions', [\App\Http\Controllers\RolePermission\RoleController::class, 'edit'])->name('roles.permissions.edit');
    Route::put('roles/{role}/permissions', [\App\Http\Controllers\RolePermission\RoleController::class, 'update'])->name('roles.permissions.update');
});

Route::get('/test-pdf', function (){
    return view('dashboard.surat_kp.pdf');
});

Route::get('/dashboard2', function () {
    return view('dashboard.layouts.main');
})->middleware(['auth', 'verified'])->name('dashboard2');

require __DIR__.'/auth.php';
