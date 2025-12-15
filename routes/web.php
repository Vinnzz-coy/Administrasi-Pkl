<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\PengaturanAkunController;

Route::get('/dashboard-pkl', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.pkl');
Route::get('/pengaturan/akun', [PengaturanAkunController::class, 'index'])->name('pengaturan.akun.index');
Route::get('/pengaturan/profil-saya', [PengaturanAkunController::class, 'indexProfile'])->name('pengaturan.profile.index');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post(uri:'/logout',action:[LogoutController::class,'logout']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::put('/pengaturan/akun', [PengaturanAkunController::class, 'update'])->name('pengaturan.akun.update');
    Route::put('/pengaturan/akun/update', [PengaturanAkunController::class, 'update'])->name('pengaturan.akun.update');
    });
