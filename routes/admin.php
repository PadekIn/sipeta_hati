<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PbbController;
use App\Http\Controllers\Admin\AsetController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SporadikController;

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
        Route::get('/destroy/{id}', [AsetController::class, 'destroy'])->name('admin.aset.destroy');
    });
    // sporadik
    Route::prefix('sporadik')->group(function () {
        Route::get('/', [SporadikController::class, 'index'])->name('admin.sporadik');
        Route::get('/detail/{rjid}', [SporadikController::class, 'detail'])->name('admin.sporadik.detail');
        Route::get('/create', [SporadikController::class, 'create'])->name('admin.sporadik.create');
        Route::post('/store', [SporadikController::class, 'store'])->name('admin.sporadik.store');
        Route::get('/edit/{id}', [SporadikController::class, 'edit'])->name('admin.sporadik.edit');
        Route::patch('/update/{id}', [SporadikController::class, 'update'])->name('admin.sporadik.update');
        Route::delete('/destroy/{id}', [SporadikController::class, 'destroy'])->name('admin.sporadik.destroy');
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
        Route::get('/{id}/detail', [WargaController::class, 'detail'])->name('admin.warga.detail');
        Route::get('/create', [WargaController::class, 'create'])->name('admin.warga.create');
        Route::get('/create/bio', [WargaController::class, 'createBio'])->name('admin.warga.createBio');
        Route::post('/store', [WargaController::class, 'store'])->name('admin.warga.store');
        Route::post('/store/bio', [WargaController::class, 'storeBio'])->name('admin.warga.storeBio');
        Route::get('/edit/{id}', [WargaController::class, 'edit'])->name('admin.warga.edit');
        Route::patch('/update/{id}', [WargaController::class, 'update'])->name('admin.warga.update');
        Route::delete('/destroy/{id}', [WargaController::class, 'destroy'])->name('admin.warga.destroy');
    });
    // user
    Route::prefix('admin')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::patch('/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    });

    // profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.profile');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    });
});
