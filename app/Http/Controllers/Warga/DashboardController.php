<?php

namespace App\Http\Controllers\Warga;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $id = Auth::user()->warga->id;
        $pengajuans = Pengajuan::with('warga')
                    ->whereNot('status', 'Diterima')
                    ->where('warga_id', $id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('pages.warga.dashboard.index', compact('pengajuans'));
    }
}
