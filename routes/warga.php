<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Warga\ProfileController;
use App\Http\Controllers\Warga\DashboardController;
use App\Http\Controllers\Warga\LaporanController;

Route::middleware(['auth', 'isWarga'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pbb', [LaporanController::class, 'pbb'])->name('pbb');
    Route::get('/saparodik', [LaporanController::class, 'saparodik'])->name('saparodik');
    Route::get('/aset', [LaporanController::class, 'aset'])->name('aset');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
