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
    public function detailSaporadik($id_aset, $id_saporadik)
    {
        return view('pages.warga.aset.saporadik');
    }
    public function detailPbb($id_aset, $id_pbb)
    {
        return view('pages.warga.aset.pbb');
    }
}
