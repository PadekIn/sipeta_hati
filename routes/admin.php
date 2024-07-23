<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PbbController;
use App\Http\Controllers\Admin\AsetController;
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SaparodikController;

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('aset')->group(function () {
        Route::get('/', [AsetController::class, 'index'])->name('admin.aset');
        Route::get('/create', [AsetController::class, 'create'])->name('admin.aset.create');
        Route::post('/store', [AsetController::class, 'store'])->name('admin.aset.store');
        Route::get('/edit/{id}', [AsetController::class, 'edit'])->name('admin.aset.edit');
        Route::patch('/update/{id}', [AsetController::class, 'update'])->name('admin.aset.update');
        Route::delete('/destroy/{id}', [AsetController::class, 'destroy'])->name('admin.aset.destroy');
        // Saparodik
        Route::prefix('{id_aset}/saparodik')->group(function () {
            Route::get('/', [SaparodikController::class, 'saparodik'])->name('admin.aset.saparodik');
            Route::get('/create', [SaparodikController::class, 'createSaparodik'])->name('admin.aset.saparodik.create');
            Route::post('/store', [SaparodikController::class, 'storeSaparodik'])->name('admin.aset.saparodik.store');
            Route::get('/edit/{id}', [SaparodikController::class, 'editSaparodik'])->name('admin.aset.saparodik.edit');
            Route::patch('/update/{id}', [SaparodikController::class, 'updateSaparodik'])->name('admin.aset.saparodik.update');
            Route::delete('/destroy/{id}', [SaparodikController::class, 'destroySaparodik'])->name('admin.aset.saparodik.destroy');
        });
        // pbb
        Route::prefix('/{id_aset}/pbb')->group(function () {
            Route::get('/', [PbbController::class, 'pbb'])->name('admin.aset.pbb');
            Route::get('/create', [PbbController::class, 'createPbb'])->name('admin.aset.pbb.create');
            Route::post('/store', [PbbController::class, 'storePbb'])->name('admin.aset.pbb.store');
            Route::get('/edit/{id}', [PbbController::class, 'editPbb'])->name('admin.aset.pbb.edit');
            Route::patch('/update/{id}', [PbbController::class, 'updatePbb'])->name('admin.aset.pbb.update');
            Route::delete('/destroy/{id}', [PbbController::class, 'destroyPbb'])->name('admin.aset.pbb.destroy');
        });
    });

    Route::get('/saparodik', [SaparodikController::class, 'index'])->name('admin.saparodik');
    Route::get('/pbb', [PbbController::class, 'index'])->name('admin.pbb');

    Route::prefix('warga')->group(function () {
        Route::get('/', [WargaController::class, 'index'])->name('admin.warga');
        Route::get('/create', [WargaController::class, 'create'])->name('admin.warga.create');
        Route::post('/store', [WargaController::class, 'store'])->name('admin.warga.store');
        Route::get('/edit/{id}', [WargaController::class, 'edit'])->name('admin.warga.edit');
        Route::patch('/update/{id}', [WargaController::class, 'update'])->name('admin.warga.update');
        Route::delete('/destroy/{id}', [WargaController::class, 'destroy'])->name('admin.warga.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
