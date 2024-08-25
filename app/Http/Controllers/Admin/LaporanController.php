<?php

namespace App\Http\Controllers\admin;

use App\Models\Pbb;
use App\Models\Sporadik;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LaporanController extends Controller
{
    public function pbb()
    {
        try {
            $pbbs = Pbb::with('pengajuan')->get();
            return view('pages.admin.laporan.pbb', compact('pbbs'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Server Error');
        }
    }

    public function sporadik()
    {
        try {
            $sporadiks = Sporadik::with('pengajuan', 'pemilik_lama', 'pemilik_baru')->get();
            return view('pages.admin.laporan.sporadik', compact('sporadiks'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Server Error'. $th->getMessage());
        }
    }
}
