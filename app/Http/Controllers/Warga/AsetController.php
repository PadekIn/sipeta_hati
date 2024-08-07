<?php

namespace App\Http\Controllers\Warga;

use Illuminate\Http\Request;

class AsetController
{
    public function index()
    {
        return view('pages.warga.aset.list');
    }
    public function detail($id)
    {
        return view('pages.warga.aset.detail');
    }
    public function detailSporadik($id_aset, $id_sporadik)
    {
        return view('pages.warga.aset.sporadik');
    }
    public function detailPbb($id_aset, $id_pbb)
    {
        return view('pages.warga.aset.pbb');
    }
}
