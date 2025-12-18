<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuratController;

Route::redirect('/', '/dashboard');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Surat Routes
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    Route::get('/surat/penjajakan', [SuratController::class, 'penjajakan'])->name('surat.penjajakan');
    Route::post('/surat/penjajakan/preview', [SuratController::class, 'previewPenjajakan'])->name('surat.penjajakan.preview');
    Route::post('/surat/penjajakan/download', [SuratController::class, 'downloadPenjajakan'])->name('surat.penjajakan.download');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('siswa', SiswaController::class);
});