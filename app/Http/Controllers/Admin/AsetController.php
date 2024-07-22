<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Warga;
use Illuminate\Http\Request;

class AsetController
{
    public function index()
    {
        $aset = Aset::all();
        return view('pages.admin.aset.list', compact('aset'));
    }

    public function create()
    {
        $warga = Warga::all();
        return view('pages.admin.aset.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'jenis_barang' => 'required',
            'luas' => 'required',
            'alamat' => 'required',
        ]);

        Aset::create($request->all());
        return redirect()->route('aset.index');
    }

    public function edit(Aset $aset)
    {
        $warga = Warga::all();
        return view('pages.admin.aset.edit', compact('aset', 'warga'));
    }

    public function update(Request $request, Aset $aset)
    {
        $request->validate([
            'warga_id' => 'required',
            'jenis_barang' => 'required',
            'luas' => 'required',
            'alamat' => 'required',
        ]);

        $aset->update($request->all());
        return redirect()->route('aset.index');
    }

    public function destroy(Aset $aset)
    {
        $aset->delete();
        return redirect()->route('aset.index');
    }
}
