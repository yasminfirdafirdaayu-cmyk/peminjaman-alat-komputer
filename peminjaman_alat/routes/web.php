<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LogAktivitasController;

// ==========================================
// ROUTE PENGUNJUNG
// ==========================================

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');

});

// ==========================================
// ROUTE LOGOUT
// ==========================================

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ==========================================
// ROUTE ADMIN
// ==========================================

Route::middleware(['auth', 'role:admin'])->group(function () {

    // DASHBOARD ADMIN
    Route::get('/dashboard-admin', function () {

        $totalAlat = \App\Models\Alat::count();
        $totalUser = \App\Models\User::count();
        $totalPeminjaman = \App\Models\Peminjaman::count();

        return view('dashboard.admin', compact(
            'totalAlat',
            'totalUser',
            'totalPeminjaman'
        ));

    })->name('dashboard.admin');

    // MANAJEMEN DATA
    Route::resource('alat', AlatController::class);
    Route::resource('user', UserController::class);
    Route::resource('kategori', KategoriController::class);

    // PEMINJAMAN ADMIN
    Route::get('/admin/peminjaman', [PeminjamanController::class, 'adminIndex'])
        ->name('admin.peminjaman.index');

    Route::delete('/admin/peminjaman/{peminjaman}', [PeminjamanController::class, 'adminDestroy'])
        ->name('admin.peminjaman.destroy');

    // LAPORAN ADMIN
    Route::get('/admin/laporan', [LaporanController::class, 'index'])
        ->name('laporan.admin.index');

    // LOG AKTIVITAS
    Route::get('/admin/log-aktivitas', [LogAktivitasController::class, 'index'])
        ->name('admin.log-aktivitas.index');

});

// ==========================================
// ROUTE PETUGAS
// ==========================================

Route::middleware(['auth', 'role:petugas'])->group(function () {

    // DASHBOARD PETUGAS
    Route::get('/dashboard-petugas', function () {

        $totalPeminjaman = \App\Models\Peminjaman::count();

        $totalMenunggu = \App\Models\Peminjaman::where('status', 'menunggu')
            ->count();

        $totalDisetujui = \App\Models\Peminjaman::where('status', 'disetujui')
            ->count();

        $totalPengembalian = \App\Models\Peminjaman::where('status', 'dikembalikan')
            ->count();

        return view('dashboard.petugas', compact(
            'totalPeminjaman',
            'totalMenunggu',
            'totalDisetujui',
            'totalPengembalian'
        ));

    })->name('dashboard.petugas');

    // DATA ALAT KHUSUS PETUGAS (HANYA MELIHAT)
    Route::get('/petugas/data-alat', function () {

        $alats = \App\Models\Alat::with('kategori')
            ->latest()
            ->get();

        return view('alat.petugas', compact('alats'));

    })->name('petugas.alat.index');

    // DATA PEMINJAMAN
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])
        ->name('peminjaman.index');

    Route::post('/peminjaman/{peminjaman}/setujui', [PeminjamanController::class, 'setujui'])
        ->name('peminjaman.setujui');

    Route::post('/peminjaman/{peminjaman}/tolak', [PeminjamanController::class, 'tolak'])
        ->name('peminjaman.tolak');

    // DATA PENGEMBALIAN
    Route::get('/pengembalian', [PengembalianController::class, 'index'])
        ->name('pengembalian.index');

    Route::get('/pengembalian/{peminjaman}', [PengembalianController::class, 'show'])
        ->name('pengembalian.show');

    // LAPORAN PETUGAS
    Route::get('/petugas/laporan', [LaporanController::class, 'index'])
        ->name('laporan.petugas.index');

    Route::get('/petugas/nota/{peminjaman}', [LaporanController::class, 'nota'])
        ->name('laporan.petugas.nota');

});

// ==========================================
// ROUTE PEMINJAM
// ==========================================

Route::middleware(['auth', 'role:peminjam'])->group(function () {

    // DASHBOARD PEMINJAM
    Route::get('/dashboard-peminjam', function () {

        $alatTersedia = \App\Models\Alat::where('stok', '>', 0)
            ->count();

        $totalPeminjamanSaya = \App\Models\Peminjaman::where('user_id', auth()->id())
            ->count();

        return view('dashboard.peminjam', compact(
            'alatTersedia',
            'totalPeminjamanSaya'
        ));

    })->name('dashboard.peminjam');

    // HALAMAN PENGGUNA
    Route::get('/pengguna', function () {
        return view('pengguna.index');
    })->name('pengguna.index');

    // DAFTAR ALAT PEMINJAM
    Route::get('/daftar-alat', [AlatController::class, 'index'])
        ->name('pengguna.alat');

    // PENGAJUAN PEMINJAMAN
    Route::get('/ajukan-peminjaman/{alat}', [PeminjamanController::class, 'create'])
        ->name('peminjaman.create');

    Route::post('/ajukan-peminjaman', [PeminjamanController::class, 'store'])
        ->name('peminjaman.store');

    // PEMINJAMAN SAYA
    Route::get('/peminjaman-saya', [PeminjamanController::class, 'saya'])
        ->name('peminjaman.saya');

    // PENGEMBALIAN PEMINJAM
    Route::get('/pengembalian-saya', [PeminjamanController::class, 'pengajuanSaya'])
        ->name('pengembalian.peminjam.index');

    Route::post('/pengembalian-saya/{peminjaman}/ajukan', [PeminjamanController::class, 'ajukanPengembalian'])
        ->name('pengembalian.peminjam.ajukan');

});