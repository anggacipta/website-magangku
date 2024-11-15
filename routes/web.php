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

    // Route get Mahasiswa and Perusahaan by Id
    Route::get('/mahasiswa/{id}', [\App\Http\Controllers\Profile\MahasiswaProfileController::class, 'showById'])->name('mahasiswa.show');
    Route::get('/perusahaan/{id}', [\App\Http\Controllers\Profile\PerusahaanProfileController::class, 'showById'])->name('perusahaan.show');

    // Route Mahasiswa
    Route::resource('mahasiswa', \App\Http\Controllers\Admin\MahasiswaController::class);

    // Route Perusahaan
    Route::resource('perusahaan', \App\Http\Controllers\Admin\PerusahaanController::class);

    // Route riwayat magang
    Route::resource('riwayat-magang', \App\Http\Controllers\Admin\RiwayatMagangController::class);

    // Route roles permissions management
    Route::resource('permissions', \App\Http\Controllers\RolePermission\PermissionController::class);
    Route::resource('roles', \App\Http\Controllers\RolePermission\RoleController::class);
});

Route::get('/dashboard2', function () {
    return view('dashboard.layouts.main');
})->middleware(['auth', 'verified'])->name('dashboard2');

require __DIR__.'/auth.php';
