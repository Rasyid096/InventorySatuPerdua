<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\LaporanStokController;
use App\Http\Controllers\LaporanBarangMasukController;
use App\Http\Controllers\LaporanBarangKeluarController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\PresetBarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ActivityLogController;

Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'proses']);
Route::post('/register-first-user', [AuthController::class, 'registerFirstUser']);
Route::post('/forgot-password/question', [AuthController::class, 'lookupRecoveryQuestion']);
Route::post('/forgot-password/reset', [AuthController::class, 'resetPassword']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::prefix('master-data')->group(function () {
        // Data Barang
        Route::get('/data-barang', [DataBarangController::class, 'index'])->name('master-data.data-barang');
        Route::put('/data-barang/{id}', [DataBarangController::class, 'update']);
        Route::delete('/data-barang/{id}', [DataBarangController::class, 'destroy'])->middleware('role:Admin');
        Route::delete('/data-barang/hapus-semua', [DataBarangController::class, 'hapusSemua'])->middleware('role:Admin');
    });

    // Transaksi
    Route::prefix('transaksi')->group(function () {
        // Barang Masuk
        Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('transaksi.barang-masuk');
        Route::post('/barang-masuk', [BarangMasukController::class, 'store']);
        Route::put('/barang-masuk/{id}', [BarangMasukController::class, 'update']);
        Route::delete('/barang-masuk/{id}', [BarangMasukController::class, 'destroy'])->middleware('role:Admin');
        Route::delete('/barang-masuk/hapus-semua', [BarangMasukController::class, 'hapusSemua'])->middleware('role:Admin');

        // Barang Keluar
        Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('transaksi.barang-keluar');
        Route::post('/barang-keluar', [BarangKeluarController::class, 'store']);
        Route::put('/barang-keluar/{id}', [BarangKeluarController::class, 'update']);
        Route::delete('/barang-keluar/{id}', [BarangKeluarController::class, 'destroy'])->middleware('role:Admin');
        Route::delete('/barang-keluar/hapus-semua', [BarangKeluarController::class, 'hapusSemua'])->middleware('role:Admin');
    });

    // Laporan
    Route::prefix('laporan')->group(function () {
        Route::get('/stok', [LaporanStokController::class, 'index'])->name('laporan.stok');
        Route::get('/stok/cetak', [LaporanStokController::class, 'cetak']);
        Route::get('/stok/export', [LaporanStokController::class, 'export']);

        Route::get('/barang-masuk', [LaporanBarangMasukController::class, 'index'])->name('laporan.barang-masuk');
        Route::get('/barang-masuk/cetak', [LaporanBarangMasukController::class, 'cetak']);
        Route::get('/barang-masuk/export', [LaporanBarangMasukController::class, 'export']);

        Route::get('/barang-keluar', [LaporanBarangKeluarController::class, 'index'])->name('laporan.barang-keluar');
        Route::get('/barang-keluar/cetak', [LaporanBarangKeluarController::class, 'cetak']);
        Route::get('/barang-keluar/export', [LaporanBarangKeluarController::class, 'export']);
    });

    // Pengaturan
    Route::prefix('pengaturan')->group(function () {
        // Preset Barang
        Route::get('/preset-barang', [PresetBarangController::class, 'index'])->name('pengaturan.preset-barang');
        Route::post('/preset-barang', [PresetBarangController::class, 'store']);
        Route::put('/preset-barang/{id}', [PresetBarangController::class, 'update']);
        Route::delete('/preset-barang/{id}', [PresetBarangController::class, 'destroy']);

        // Satuan Barang
        Route::get('/satuan-barang', [SatuanController::class, 'index'])->name('pengaturan.satuan-barang');
        Route::post('/satuan-barang', [SatuanController::class, 'store']);
        Route::put('/satuan-barang/{id}', [SatuanController::class, 'update']);
        Route::delete('/satuan-barang/{id}', [SatuanController::class, 'destroy']);

        // Manajemen User
        Route::get('/manajemen-user', [ManajemenUserController::class, 'index'])->name('pengaturan.manajemen-user');
        Route::post('/manajemen-user', [ManajemenUserController::class, 'store']);
        Route::put('/manajemen-user/{id}', [ManajemenUserController::class, 'update']);
        Route::delete('/manajemen-user/{id}', [ManajemenUserController::class, 'destroy']);

        // Backup Database
        Route::get('/backup-database', [BackupController::class, 'index'])->name('pengaturan.backup-database');
        Route::get('/backup-database/download', [BackupController::class, 'download']);
    });

    // Activity Log
    Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log')->middleware('role:Admin');
    Route::delete('/activity-log/hapus-semua', [ActivityLogController::class, 'hapusSemua'])->name('activity-log.hapus-semua')->middleware('role:Admin');

    // Tentang Aplikasi
    Route::view('/tentang', 'admin.tentang_aplikasi')->name('tentang');
});
