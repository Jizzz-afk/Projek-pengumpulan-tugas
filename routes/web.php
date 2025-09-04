<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CekRole;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->intended(auth::user()->role . '/dashboard');
    }
    return redirect()->route('login');
});


Route::middleware(['auth', CekRole::class . ':admin' ])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/guru', [DashboardController::class, 'guruIndex'])->name('admin.guru.index');
    Route::post('/guru', [DashboardController::class, 'guruStore']);
    Route::get('/guru/{id}/edit', [DashboardController::class, 'guruEdit'])->name('admin.guru.edit');
    Route::put('/guru/{id}', [DashboardController::class, 'guruUpdate'])->name('admin.guru.update');
    Route::delete('/guru/{id}', [DashboardController::class, 'guruDelete']);

    Route::get('/siswa', [DashboardController::class, 'siswaIndex'])->name('admin.siswa.index');
    Route::post('/siswa', [DashboardController::class, 'siswaStore']);
    Route::get('/siswa/{id}/edit', [DashboardController::class, 'siswaEdit'])->name('admin.siswa.edit');
    Route::put('/siswa/{id}', [DashboardController::class, 'siswaUpdate'])->name('admin.siswa.update');
    Route::delete('/siswa/{id}', [DashboardController::class, 'siswaDelete']);

    Route::get('/kelas', [DashboardController::class, 'kelasIndex'])->name('admin.kelas.index');
    Route::post('/kelas', [DashboardController::class, 'kelasStore']);
    Route::get('/kelas/{id}/edit', [DashboardController::class, 'kelasEdit'])->name('admin.kelas.edit');
    Route::put('/kelas/{id}', [DashboardController::class, 'kelasUpdate'])->name('admin.kelas.update');
    Route::delete('/kelas/{id}', [DashboardController::class, 'kelasDelete']);
    Route::get('/kelas/{id}/detail', [DashboardController::class, 'kelasDetail'])->name('admin.kelas.detail');

    Route::get('/mapel', [DashboardController::class, 'mapelIndex'])->name('admin.mapel.index');
    Route::post('/mapel', [DashboardController::class, 'mapelStore'])->name('admin.mapel.store');
    Route::get('/mapel/{id}/edit', [DashboardController::class, 'mapelEdit'])->name('admin.mapel.edit');
    Route::put('/mapel/{id}', [DashboardController::class, 'mapelUpdate'])->name('admin.mapel.update');
    Route::delete('/mapel/{id}', [DashboardController::class, 'mapelDelete'])->name('admin.mapel.destroy');

    Route::get('/user', [DashboardController::class, 'userIndex'])->name('admin.users.index');
    Route::post('/user/{id}/role', [DashboardController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::post('/user/{id}/status', [DashboardController::class, 'toggleStatus'])->name('admin.users.toggleStatus');
    });

Route::middleware(['auth', CekRole::class . ':siswa'])->prefix('siswa')->as('siswa.')->group(function () {
        Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('/profil', [SiswaController::class, 'profil'])->name('profil');
        Route::get('/kelas', [SiswaController::class, 'kelas'])->name('kelas');
        Route::get('/nilai', [SiswaController::class, 'nilai'])->name('nilai');
        Route::get('/riwayat', [SiswaController::class, 'riwayat'])->name('riwayat');
        Route::get('/detail/{id}', [SiswaController::class, 'detail'])->name('detail');

        Route::get('/pengumpulan', [SiswaController::class, 'daftarPengumpulan'])->name('pengumpulan.index');
        Route::get('/pengumpulan/create/{tugas_id}', [SiswaController::class, 'formPengumpulan'])->name('pengumpulan.create');
        Route::post('/pengumpulan/store', [SiswaController::class, 'simpanPengumpulan'])->name('pengumpulan.store');
        Route::get('/pengumpulan/riwayat', [SiswaController::class, 'riwayatNilai'])->name('pengumpulan.riwayat');
        Route::post('/pengumpulan/simpan', [SiswaController::class, 'simpanPengumpulan'])->name('pengumpulan.simpan');
    });

Route::middleware(['auth', CekRole::class . ':guru'])->prefix('guru')->as('guru.')->group(function () {
        Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('dashboard');
        Route::get('/profil', [GuruController::class, 'profil'])->name('profil');

        Route::get('/tugas', [GuruController::class, 'tugas'])->name('tugas');
        Route::get('/tugas/buat', [GuruController::class, 'buatTugas'])->name('tugas.buat');
        Route::post('/tugas/simpan', [GuruController::class, 'simpanTugas'])->name('tugas.simpan');
        Route::get('/tugas/edit/{id}', [GuruController::class, 'editTugas'])->name('tugas.edit');
        Route::put('/tugas/{id}', [GuruController::class, 'updateTugas'])->name('tugas.update');
        Route::delete('/tugas/hapus/{id}', [GuruController::class, 'hapusTugas'])->name('tugas.hapus');

        Route::get('/penilaian', [GuruController::class, 'penilaian'])->name('penilaian');
        Route::post('/penilaian/nilai/{id}', [GuruController::class, 'beriNilai'])->name('penilaian.nilai');
    });

    
require __DIR__.'/auth.php';
