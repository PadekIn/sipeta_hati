<?php

namespace App\Http\Controllers\Warga;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index()
    {
        try {
            $id = Auth::user()->warga->id;
            $pengajuans = Pengajuan::with('warga')->where('warga_id', $id)->get();

            return view('pages.warga.pengajuan.list', compact('pengajuans'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('pages.warga.pengajuan.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'jenis_surat' => 'required',
                'tanggal' => 'required',
                'perihal' => 'required',
                'keterangan' => 'required',
                'lampiran' => 'required',
            ]);

            $id = Auth::user()->warga->id;
            $pengajuan = new Pengajuan();
            $pengajuan->warga_id = $id;
            $pengajuan->jenis_surat = $request->jenis_surat;
            $pengajuan->tanggal = $request->tanggal;
            $pengajuan->perihal = $request->perihal;
            $pengajuan->keterangan = $request->keterangan;
            $pengajuan->lampiran = $request->lampiran;
            $pengajuan->status = 'Diproses';
            $pengajuan->save();

            return redirect()->route('pengajuan')->with('success', 'Pengajuan berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
