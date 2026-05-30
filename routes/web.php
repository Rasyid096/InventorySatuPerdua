<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\LaporanStokController;
use App\Http\Controllers\LaporanBarangMasukController;
use App\Http\Controllers\LaporanBarangKeluarController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\BackupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- ROUTE AUTENTIKASI ---
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'proses']);
Route::post('/register-first-user', [AuthController::class, 'registerFirstUser']);
Route::post('/forgot-password/question', [AuthController::class, 'lookupRecoveryQuestion']);
Route::post('/forgot-password/reset', [AuthController::class, 'resetPassword']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// --- ROUTE ADMIN (Dengan prefix /admin) ---
Route::prefix('admin')->middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    // Master Data Barang
    Route::get('/data-barang', [DataBarangController::class, 'index'])->name('admin.data-barang');
    Route::put('/data-barang/{id}', [DataBarangController::class, 'update']);
    Route::delete('/data-barang/{id}', [DataBarangController::class, 'destroy']);
    Route::delete('/data-barang/hapus-semua', [DataBarangController::class, 'hapusSemua']);
    
    // Transaksi Barang Masuk
    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('admin.barang-masuk');
    Route::post('/barang-masuk', [BarangMasukController::class, 'store']);
    Route::put('/barang-masuk/{id}', [BarangMasukController::class, 'update']);
    Route::delete('/barang-masuk/{id}', [BarangMasukController::class, 'destroy']);
    Route::delete('/barang-masuk/hapus-semua', [BarangMasukController::class, 'hapusSemua']);
    
    // Transaksi Barang Keluar
    Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('admin.barang-keluar');
    Route::post('/barang-keluar', [BarangKeluarController::class, 'store']);
    Route::put('/barang-keluar/{id}', [BarangKeluarController::class, 'update']);
    Route::delete('/barang-keluar/{id}', [BarangKeluarController::class, 'destroy']);
    Route::delete('/barang-keluar/hapus-semua', [BarangKeluarController::class, 'hapusSemua']);
    
    // Laporan Stok
    Route::get('/laporan-stok', [LaporanStokController::class, 'index'])->name('admin.laporan-stok');
    Route::get('/laporan-stok/cetak', [LaporanStokController::class, 'cetak']);
    Route::get('/laporan-stok/export', [LaporanStokController::class, 'export']);
    
    // Laporan Barang Masuk
    Route::get('/laporan-barang-masuk', [LaporanBarangMasukController::class, 'index'])->name('admin.laporan-barang-masuk');
    Route::get('/laporan-barang-masuk/cetak', [LaporanBarangMasukController::class, 'cetak']);
    Route::get('/laporan-barang-masuk/export', [LaporanBarangMasukController::class, 'export']);
    
    // Laporan Barang Keluar
    Route::get('/laporan-barang-keluar', [LaporanBarangKeluarController::class, 'index'])->name('admin.laporan-barang-keluar');
    Route::get('/laporan-barang-keluar/cetak', [LaporanBarangKeluarController::class, 'cetak']);
    Route::get('/laporan-barang-keluar/export', [LaporanBarangKeluarController::class, 'export']);
    
    // Manajemen User
    Route::get('/manajemen-user', [ManajemenUserController::class, 'index'])->name('admin.manajemen-user');
    Route::post('/manajemen-user', [ManajemenUserController::class, 'store']);
    Route::put('/manajemen-user/{id}', [ManajemenUserController::class, 'update']);
    Route::delete('/manajemen-user/{id}', [ManajemenUserController::class, 'destroy']);
    
    // Pengaturan Satuan
    Route::get('/pengaturan-satuan', [SatuanController::class, 'index'])->name('admin.pengaturan-satuan');
    Route::post('/pengaturan-satuan', [SatuanController::class, 'store']);
    Route::put('/pengaturan-satuan/{id}', [SatuanController::class, 'update']);
    Route::delete('/pengaturan-satuan/{id}', [SatuanController::class, 'destroy']);
    
    // Backup Database
    Route::get('/backup-database', [BackupController::class, 'index'])->name('admin.backup-database');
    Route::get('/backup-database/download', [BackupController::class, 'download']);
    
    // Tentang Aplikasi
    Route::view('/tentang-aplikasi', 'admin.tentang_aplikasi')->name('admin.tentang-aplikasi');
});
