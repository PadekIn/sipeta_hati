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
    // dashboard
    Route::prefix('aset')->group(function () {
        Route::get('/', [AsetController::class, 'index'])->name('admin.aset');
        Route::get('/detail/{id}', [AsetController::class, 'detail'])->name('admin.aset.detail');
        Route::get('/create', [AsetController::class, 'create'])->name('admin.aset.create');
        Route::post('/store', [AsetController::class, 'store'])->name('admin.aset.store');
        Route::get('/edit/{id}', [AsetController::class, 'edit'])->name('admin.aset.edit');
        Route::patch('/update/{id}', [AsetController::class, 'update'])->name('admin.aset.update');
        Route::delete('/destroy/{id}', [AsetController::class, 'destroy'])->name('admin.aset.destroy');
    });
    // Saparodik
    Route::prefix('saparodik')->group(function () {
        Route::get('/', [SaparodikController::class, 'index'])->name('admin.saparodik');
        Route::get('/detail/{id}', [SaparodikController::class, 'detail'])->name('admin.saparodik.detail');
        Route::get('/create', [SaparodikController::class, 'create'])->name('admin.saparodik.create');
        Route::post('/store', [SaparodikController::class, 'store'])->name('admin.saparodik.store');
        Route::get('/edit/{id}', [SaparodikController::class, 'edit'])->name('admin.saparodik.edit');
        Route::patch('/update/{id}', [SaparodikController::class, 'update'])->name('admin.saparodik.update');
        Route::delete('/destroy/{id}', [SaparodikController::class, 'destroy'])->name('admin.saparodik.destroy');
    });
    // pbb
    Route::prefix('pbb')->group(function () {
        Route::get('/', [PbbController::class, 'index'])->name('admin.pbb');
        Route::get('/detail/{id}', [PbbController::class, 'detail'])->name('admin.pbb.detail');
        Route::get('/create', [PbbController::class, 'create'])->name('admin.pbb.create');
        Route::post('/store', [PbbController::class, 'store'])->name('admin.pbb.store');
        Route::get('/edit/{id}', [PbbController::class, 'edit'])->name('admin.pbb.edit');
        Route::patch('/update/{id}', [PbbController::class, 'update'])->name('admin.pbb.update');
        Route::delete('/destroy/{id}', [PbbController::class, 'destroy'])->name('admin.pbb.destroy');
    });
    // warga
    Route::prefix('warga')->group(function () {
        Route::get('/', [WargaController::class, 'index'])->name('admin.warga');
        Route::get('/{id}', [WargaController::class, 'detail'])->name('admin.warga.detail');
        Route::get('/create', [WargaController::class, 'create'])->name('admin.warga.create');
        Route::get('/create/bio', [WargaController::class, 'createBio'])->name('admin.warga.createBio');
        Route::post('/store', [WargaController::class, 'store'])->name('admin.warga.store');
        Route::post('/store/bio', [WargaController::class, 'storeBio'])->name('admin.warga.storeBio');
        Route::get('/edit/{id}', [WargaController::class, 'edit'])->name('admin.warga.edit');
        Route::patch('/update/{id}', [WargaController::class, 'update'])->name('admin.warga.update');
        Route::delete('/destroy/{id}', [WargaController::class, 'destroy'])->name('admin.warga.destroy');
    });
    // profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.profile');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    });
});
