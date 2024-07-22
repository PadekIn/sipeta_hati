<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::prefix('admin')->middleware(['auth', 'isWarga'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

    Route::get('/pbb', [PbbController::class, 'index'])->name('pbb');

    Route::get('/saparodik', [SaparodikController::class, 'index'])->name('saparodik');

    Route::get('/aset', [AsetController::class, 'index'])->name('aset');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
