<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Warga\AsetController;
use App\Http\Controllers\Warga\SuratController;
use App\Http\Controllers\Warga\LaporanController;
use App\Http\Controllers\Warga\ProfileController;
use App\Http\Controllers\Warga\DashboardController;
use App\Http\Controllers\Warga\PengajuanController;

Route::middleware(['auth', 'isWarga'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pbb', [LaporanController::class, 'pbb'])->name('pbb');
    Route::get('/sporadik', [LaporanController::class, 'sporadik'])->name('sporadik');

    Route::prefix('pengajuan')->group(function () {
        Route::get('/', [PengajuanController::class, 'index'])->name('pengajuan');
        Route::get('/detail/{id}', [PengajuanController::class, 'detail'])->name('pengajuan.detail');
        Route::get('/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
        Route::post('/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
    });

    Route::prefix('asets')->group(function () {
        Route::get('/', [AsetController::class, 'index'])->name('asets');
        Route::get('/create', [AsetController::class, 'create'])->name('asets.create');
        Route::post('/store', [AsetController::class, 'store'])->name('asets.store');
        Route::get('/edit', [AsetController::class, 'edit'])->name('asets.edit');
        Route::patch('/update', [AsetController::class, 'udpate'])->name('asets.update');
        Route::delete('/destroy', [AsetController::class, 'destroy'])->name('asets.destroy');
        Route::get('/{id}', [AsetController::class, 'detail'])->name('aset.detail');
        Route::get('/pbb/{id_pbb}', [AsetController::class, 'detailPbb'])->name('aset.pbb.detail');
        Route::get('/sporadik/{id_sporadik}', [AsetController::class, 'detailSporadik'])->name('aset.sporadik.detail');
    });

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('profile.update');
    });

});
