<?php

namespace App\Http\Controllers\Warga;

use App\Models\Pbb;
use App\Models\Sporadik;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function pbb()
    {
        $warga_id = Auth::user()->warga->id;
        $pbbs = Pbb::join('pengajuans', 'pbbs.pengajuan_id', '=', 'pengajuans.id')
                    ->where('pengajuans.warga_id', $warga_id)
                    ->select('pbbs.*')
                    ->get();
        return view('pages.warga.laporan.pbb', compact('pbbs'));
    }

    public function sporadik()
    {
        $warga_id = Auth::user()->warga->id;
        $sporadiks = Sporadik::join('pengajuans', 'sporadiks.pengajuan_id', '=', 'pengajuans.id')
                    ->where('pengajuans.warga_id', $warga_id)
                    ->select('sporadiks.*')
                    ->get();
        return view('pages.warga.laporan.sporadik', compact('sporadiks'));
    }

    public function aset()
    {
        return view('pages.warga.laporan.aset');
    }
}
