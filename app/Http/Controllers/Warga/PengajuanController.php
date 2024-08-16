<?php

namespace App\Http\Controllers\Warga;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'jenis_surat' => 'required|string|in:pbb,sporadik',
                'tanggal' => 'required|date',
                'perihal' => 'required|string',
                'keterangan' => 'required|string',
                'lampiran' => 'required|mimes:pdf',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            }

            // Handle image upload
            if ($request->hasFile('lampiran')) {
                $lampiran = $request->file('lampiran');
                $lampiranName = time() . '_' . $lampiran->getClientOriginalName();
                $lampiran->storeAs('/lampiran_warga', $lampiranName, 'public_custom');
            } else {
                $lampiranName = null;
            }

            $id = Auth::user()->warga->id;

            $pengajuan = array_merge($request->all(), [
                'warga_id' => $id,
                'lampiran' => $lampiranName,
                'status' => 'Diproses',
            ]);

            Pengajuan::create($pengajuan);

            return redirect()->route('pengajuan')->with('success', 'Pengajuan berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
