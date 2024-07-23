<?php

use App\Http\Controllers\Warga\AsetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Warga\ProfileController;
use App\Http\Controllers\Warga\DashboardController;
use App\Http\Controllers\Warga\LaporanController;

Route::middleware(['auth', 'isWarga'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pbb', [LaporanController::class, 'pbb'])->name('pbb');
    Route::get('/aset', [LaporanController::class, 'saparodik'])->name('saparodik');

    Route::prefix('asets')->group(function () {
        Route::get('/', [AsetController::class, 'index'])->name('asets');
        Route::get('/{id}', [AsetController::class, 'detail'])->name('aset.detail');
    });

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::get('/detail/{id}', [ProfileController::class, 'detail'])->name('profile.detail');
        Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/update/{id}', [ProfileController::class, 'update'])->name('profile.udpate');
    });

});
