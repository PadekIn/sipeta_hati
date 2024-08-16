<?php

namespace App\Http\Controllers\Warga;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PengajuanController extends Controller
{
    public function index()
    {
        return view('pages.warga.pengajuan.list');
    }

    public function surat()
    {
        return view('pages.warga.pengajuan.surat');
    }
}
