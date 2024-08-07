<?php

namespace App\Http\Controllers\Admin;

use App\Models\Aset;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vinkla\Hashids\Facades\Hashids;

class AsetController extends Controller
{
    public function index()
    {
        $asets = Aset::all();
        return view('pages.admin.aset.list', compact('asets'));
    }

    public function detail($id)
    {
        $aset = Aset::all();
        return view('pages.admin.aset.detail', compact('aset', 'id'));
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

        $aset = Aset::where('warga_id', Hashids::decode($request->warga_id)[0])
                    ->where('jenis_barang', $request->jenis_barang)
                    ->where('luas', $request->luas)
                    ->first();

        if ($aset) {
            return redirect()->route('admin.aset')->with('error', 'Data aset sudah ada');
        }

        $warga_id = Hashids::decode($request->warga_id)[0];

        Aset::create([
            'warga_id' => $warga_id,
            'jenis_barang' => $request->jenis_barang,
            'luas' => $request->luas,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.aset')->with('success', 'Data aset berhasil ditambahkan');
    }

    public function edit($id)
    {
        $unhashed = Hashids::decode($id)[0];
        $warga = Warga::all();
        $aset = Aset::find($unhashed);

        return view('pages.admin.aset.edit', compact('aset', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'warga_id' => 'required',
            'jenis_barang' => 'required',
            'luas' => 'required',
            'alamat' => 'required',
        ]);
        $unhashed = Hashids::decode($id)[0];
        $aset = Aset::find($unhashed);
        $warga_id = Hashids::decode($request->warga_id)[0];

        $aset->update([
            'warga_id' => $warga_id,
            'jenis_barang' => $request->jenis_barang,
            'luas' => $request->luas,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.aset')->with('success', 'Data aset berhasil diubah');
    }

    public function destroy($id)
    {
        $unhashed = Hashids::decode($id)[0];
        $aset = Aset::find($unhashed);
        $aset->delete();
        return redirect()->route('admin.aset');
    }
}
