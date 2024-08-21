<?php

namespace App\Http\Controllers\Warga;

use App\Models\Pbb;
use App\Models\Aset;
use App\Models\Warga;
use App\Models\Sporadik;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AsetController
{
    public function index()
    {
        try {
            $id = Auth::user()->warga->id;
            $asets = Aset::with('warga')->where('warga_id', $id)->get();

            return view('pages.warga.aset.list', compact('asets'));
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan'). $th->getMessage();
        }
    }

    public function create():View
    {
        return view('pages.warga.aset.create');
    }

    public function store(Request $request)
    {
        try {
            $id = Auth::user()->warga->id;

            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'jenis_barang' => 'required|string|in:tanah,bangunan',
                'luas' => 'required|integer',
                'alamat' => 'required|string',
                'lampiran' => 'required|file|mimes:pdf',
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
                $lampiran->storeAs('/warga/aset', $lampiranName, 'public_custom');
            } else {
                $lampiranName = null;
            }

            $data = array_merge($request->all(), [
                'warga_id' => $id,
                'lampiran' => $lampiranName,
            ]);

            Aset::create($data);
            return redirect()->route('asets')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan'). $th->getMessage();
        }
    }

    // public function edit($id)
    // {
    //     try {
    //         $unhashed = Hashids::decode($id)[0];
    //         $aset = Aset::find($unhashed);
    //         return view('pages.warga.aset.edit', compact('aset'));
    //     } catch (\Throwable $th) {
    //         return redirect()->route('asets')->with('error', 'Server Error');
    //     }
    // }

    // public function update()
    // {
    //     try {
    //         $data = request()->validate([
    //             'no_sertifikat' => 'required',
    //             'luas_tanah' => 'required',
    //             'luas_bangunan' => 'required',
    //             'alamat' => 'required',
    //             'status' => 'required',
    //             'keterangan' => 'required',
    //         ]);

    //         $aset = Aset::find($data['id']);
    //         $aset->update($data);
    //         return redirect()->route('asets')->with('success', 'Data berhasil diubah');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Terjadi kesalahan'). $th->getMessage();
    //     }
    // }

    // public function destroy()
    // {
    //     try {
    //         $data = request()->validate([
    //             'id' => 'required',
    //         ]);

    //         $aset = Aset::find($data['id']);
    //         $aset->delete();
    //         return redirect()->route('asets')->with('success', 'Data berhasil dihapus');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Terjadi kesalahan'). $th->getMessage();
    //     }
    // }

    public function detail($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $warga_id = Auth::user()->warga->id;
            $aset = Aset::with('warga')->find($unhashed);
            $pbb = Pbb::whereHas('pengajuan', function ($query) use ($warga_id) {
                $query->where('warga_id', $warga_id);
            })->get();

            $sporadik = Sporadik::whereHas('pengajuan', function ($query) use ($warga_id) {
                $query->where('warga_id', $warga_id);
            })->get();
            return view('pages.warga.aset.detail', compact('aset', 'pbb', 'sporadik'));
        } catch (\Throwable $th) {
            return redirect()->route('asets')->with('error', 'Server Error'. $th->getMessage());
        }
    }

    public function detailSporadik($id_sporadik)
    {
        try {
            $unhashed = Hashids::decode($id_sporadik)[0];
            $sporadik = Sporadik::with('pengajuan', 'pemilik_lama', 'pemilik_baru')->where('id', $unhashed)->first();
            return view('pages.warga.aset.sporadik', compact('sporadik'));
        } catch (\Throwable $th) {
            return redirect()->route('asets')->with('error', 'Server Error'). $th->getMessage();
        }
    }

    public function detailPbb($id_pbb)
    {
        try {
            $unhashed = Hashids::decode($id_pbb)[0];
            $pbb = Pbb::where('id', $unhashed)->first();
            return view('pages.warga.aset.pbb', compact('pbb'));
        } catch (\Throwable $th) {
            return redirect()->route('asets')->with('error', 'Server Error'). $th->getMessage();
        }
    }
}
