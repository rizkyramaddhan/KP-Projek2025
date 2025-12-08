<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SPKController;
use App\Http\Controllers\GasItemController;
use App\Http\Controllers\penggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\transaksiController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\pengaturanController;
use App\Http\Controllers\logActivityController;
use App\Http\Controllers\tramsalsiController;


// ---------------------------
// AUTH ROUTES (bebas akses)
// ---------------------------
Route::get('/', [LoginController::class, 'showLoginFrom'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ---------------------------
// ROUTE YANG HARUS LOGIN
// ---------------------------
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Log Activity
    Route::get('/logActivity', [logActivityController::class, 'index'])->name('logactivity.index');

    // SPK Menu
    Route::get('/spk', [SPKController::class, 'index'])->name('spk.index');

    // Pengguna
    Route::get('/pengguna', [penggunaController::class, 'index'])->name('pengguna.index');
    Route::post('/pengguna', [penggunaController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{id}', [penggunaController::class, 'show']);
    Route::put('/pengguna/{id}', [penggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    // Route::put('/pengguna/{id}', [penggunaController::class, 'tambahStok'])->name('pengguna.updateStok');


    // Produk Gas
    Route::resource('gas', GasItemController::class)
        ->parameters(['gas' => 'gas']);
        // Tambah Stok Gas
Route::post('/gas/tambah-stok', [GasItemController::class, 'tambahStok'])
    ->name('gas.tambah-stok');


    // Transaksi Gas
    Route::get('/transaksi', [transaksiController::class, 'index'])->name('transaksi.index');

    // Pengaturan
    Route::get('/pengaturan', [pengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan/{id}', [pengaturanController::class, 'update'])->name('pengaturan.update');
});
