<?php

namespace App\Http\Controllers\Warga;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.warga.dashboard.index');
    }
}
