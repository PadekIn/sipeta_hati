<?php

namespace App\Http\Controllers\Warga;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LaporanController extends Controller
{
    public function pbb()
    {
        return view('pages.warga.laporan.pbb');
    }

    public function sporadik()
    {
        return view('pages.warga.laporan.sporadik');
    }

    public function aset()
    {
        return view('pages.warga.laporan.aset');
    }
}
