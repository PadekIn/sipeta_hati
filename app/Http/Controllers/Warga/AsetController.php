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
}
