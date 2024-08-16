<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vinkla\Hashids\Facades\Hashids;

class PengajuanController extends Controller
{
    public function index()
    {
        try {
            $pengajuans = Pengajuan::with('warga')->orderBy('status', 'desc')->orderBy('created_at', 'desc')->get();

            return view('pages.admin.pengajuan.list', compact('pengajuans'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function detail($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $pengajuan = Pengajuan::with('warga')->find($unhashed);

            return view('pages.admin.pengajuan.detail', compact('pengajuan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function approved($jenis, $id)
    {
        try {
            if($jenis == 'pbb') {
                return redirect()->route('admin.pbb.create')->with('pengajuan_id', $id)->with('success', 'Pengajuan diterima, silahkan buat surat PBB');
            } else if($jenis == 'sporadik') {
                return redirect()->route('admin.sporadik.create')->with('pengajuan_id', $id)->with('success', 'Pengajuan diterima, silahkan buat surat Sporadik');
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan: Jenis pengajuan tidak ditemukan');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejected($id, Request $request)
    {
        try {
            $request->validate([
                'pesan' => 'required|string'
            ]);
            $unhashed = Hashids::decode($id)[0];
            $pengajuan = Pengajuan::find($unhashed);
            $pengajuan->status = 'Ditolak';
            $pengajuan->pesan = $request->pesan;
            $pengajuan->save();

            return redirect()->back()->with('success', 'Pengajuan berhasil ditolak');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
