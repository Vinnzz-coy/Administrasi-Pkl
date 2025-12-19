<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DudiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DataPembimbingController;
use App\Http\Controllers\DudiControllerr;


Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::resource('dudi', DudiController::class);



Route::get('/profile', action: [ProfileController::class, 'index'])
        ->name('profile.edit');

    Route::post('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');


Route::get('/pembimbing', [DataPembimbingController::class, 'index'])
    ->name('pembimbing.index');

Route::get('/pembimbing/create', [DataPembimbingController::class, 'create'])
    ->name('pembimbing.create');

Route::post('/pembimbing', [DataPembimbingController::class, 'store'])
    ->name('pembimbing.store');

Route::get('/pembimbing/{pembimbing}', [DataPembimbingController::class, 'show'])
    ->name('pembimbing.show');

Route::get('/pembimbing/{pembimbing}/edit', [DataPembimbingController::class, 'edit'])
    ->name('pembimbing.edit');

Route::put('/pembimbing/{pembimbing}', [DataPembimbingController::class, 'update'])
    ->name('pembimbing.update');

Route::delete('/pembimbing/{pembimbing}', [DataPembimbingController::class, 'destroy'])
    ->name('pembimbing.destroy');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/nama-perusahaan', [DudiController::class, 'index'])
    ->name('nama_perusahaan.index');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
