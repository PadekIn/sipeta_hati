<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\PbbController;
use App\Http\Controllers\Admin\AsetController;
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SaparodikController;

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('admin.dashboard');

    Route::get('/pbb', [PbbController::class, 'index'])->name('admin.pbb');

    Route::get('/saparodik', [SaparodikController::class, 'index'])->name('admin.saparodik');

    Route::get('/aset', [AsetController::class, 'index'])->name('admin.aset');

    Route::get('/warga', [WargaController::class, 'index'])->name('admin.warga');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
