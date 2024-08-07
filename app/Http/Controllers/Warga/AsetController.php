<?php

namespace App\Http\Controllers\Warga;

use App\Models\Pbb;
use App\Models\Aset;
use App\Models\Warga;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Sporadik;

class AsetController
{
    public function index()
    {
        try {
            $warga = Warga::where('id', auth()->user()->id)->first();
            $asets = Aset::where('warga_id', $warga->id)->get();
            return view('pages.warga.aset.list', compact('asets'));
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan'). $th->getMessage();
        }
    }
    public function detail($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $aset = Aset::with('warga')->find($unhashed);
            $pbb = Pbb::with('aset')->where('aset_id', $unhashed)->get();
            $sporadik = Sporadik::with('aset')->where('aset_id', $unhashed)->get();
            return view('pages.warga.aset.detail', compact('aset', 'pbb', 'sporadik'));
        } catch (\Throwable $th) {
            return redirect()->route('warga.aset')->with('error', 'Server Error');
        }
    }
    public function detailSporadik($id_aset, $id_sporadik)
    {
        try {
            $unhashed = Hashids::decode($id_sporadik)[0];
            $sporadik = Sporadik::with('aset', 'pemilik_lama', 'pemilik_baru')->where('id', $unhashed)->first();
            return view('pages.warga.aset.sporadik', compact('sporadik'));
        } catch (\Throwable $th) {
            return redirect()->route('warga.aset')->with('error', 'Server Error'). $th->getMessage();
        }
    }
    public function detailPbb($id_aset, $id_pbb)
    {
        try {
            $unhashed = Hashids::decode($id_pbb)[0];
            $pbb = Pbb::with('aset', 'user')->where('id', $unhashed)->first();
            return view('pages.warga.aset.pbb', compact('pbb'));
        } catch (\Throwable $th) {
            return redirect()->route('warga.aset')->with('error', 'Server Error'). $th->getMessage();
        }
    }
}
