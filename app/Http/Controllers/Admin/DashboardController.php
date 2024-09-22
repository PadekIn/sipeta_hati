<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengajuan;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with('warga')
                    ->whereNot('status', 'Diterima')
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('pages.admin.dashboard.index', compact('pengajuans'));
    }
}
