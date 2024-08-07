<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pbb;
use App\Models\Aset;
use App\Models\Warga;
use App\Models\Sporadik;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vinkla\Hashids\Facades\Hashids;

class AsetController extends Controller
{
    public function index()
    {
        try {
            $asets = Aset::all();
            return view('pages.admin.aset.list', compact('asets'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Server Error');
        }
    }

    public function detail($id)
    {
        $unhashed = Hashids::decode($id)[0];
        $aset = Aset::with('warga')->find($unhashed);
        $pbb = Pbb::with('aset')->where('aset_id', $unhashed)->get();
        $sporadik = Sporadik::with('aset')->where('aset_id', $unhashed)->get();
        return view('pages.admin.aset.detail', compact('aset', 'pbb', 'sporadik'));
    }

    public function create()
    {
        try {
            $warga = Warga::all();
            return view('pages.admin.aset.create', compact('warga'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.aset')->with('error', 'Server Error');
        }
    }

    public function store(Request $request)
    {
        try {
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
        } catch (\Throwable $th) {
            return redirect()->route('admin.aset')->with('error', 'Server Error, data aset gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $warga = Warga::all();
            $aset = Aset::find($unhashed);

            return view('pages.admin.aset.edit', compact('aset', 'warga'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.aset')->with('error', 'Server Error');
        }
    }

    public function update(Request $request, $id)
    {
        try {
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
        } catch (\Throwable $th) {
            return redirect()->route('admin.aset')->with('error', 'Server Error, data aset gagal diubah');
        }
    }

    public function destroy($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $aset = Aset::find($unhashed);
            $aset->delete();
            return redirect()->route('admin.aset')->with('success', 'Data aset berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('admin.aset')->with('error', 'Server Error, data aset gagal dihapus');
        }
    }
}
