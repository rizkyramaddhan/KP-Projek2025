<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GasItemController;
use App\Http\Controllers\logActivityController;
use App\Models\LogActivity;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\SPKController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginFrom'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/log-activity', [logActivityController::class, 'index'])->name('logactivity.index');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('gas', GasItemController::class)->middleware('auth')->parameters([
    'gas' => 'gas'
]);

// Halaman daftar barang & menu SPK
Route::get('/spk', [SPKController::class, 'index'])->name('spk.index');






Route::get('/sidebar', function (){
    return view('layout.body.sidebar');
})->name('dashboard');

