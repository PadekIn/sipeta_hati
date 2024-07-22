<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/warga.php';
