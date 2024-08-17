<?php

namespace App\Http\Controllers\Admin;

use App\Models\Aset;
use App\Models\Warga;
use App\Models\Sporadik;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Validator;

class SporadikController extends Controller
{
    public function index()
    {
        try {
            $sporadiks = Sporadik::with('pengajuan', 'pemilik_lama', 'pemilik_baru')->get();
            return view('pages.admin.sporadiks.list', compact('sporadiks'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Server Error'. $th->getMessage());
        }
    }

    public function create()
    {
        try {
            $pengajuans = Pengajuan::with('warga')->where('jenis_surat', 'sporadik')->where('status', 'Diproses')->get();
            $asets = Aset::with('warga')->get();
            $warga = Warga::with('aset')->get();
            return view('pages.admin.sporadiks.create', compact('asets', 'warga', 'pengajuans'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.sporadik')->with('error', 'Server Error'. $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'pemilik_lama_id' => 'required|string',
                'pemilik_baru_id' => 'required|string',
                'pengajuan_id' => 'required|string',
                'no_surat' => 'required|string',
                'tanggal_surat' => ['required', 'date', 'after_or_equal:today'],
                'aset_id' => 'nullable|string',
                'jenis_barang' => 'nullable|string',
                'luas' => 'nullable|string',
                'alamat' => 'nullable|string',
                'lampiran' => 'required|file|mimes:pdf',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            }

            if($request->pemilik_lama_id == $request->pemilik_baru_id){
                return redirect()->back()->with('error', 'Pemilik lama dan pemilik baru tidak boleh sama');
            }

            $surat = Sporadik::where('no_surat', $request->no_surat)->first();

            if ($surat) {
                return redirect()->back()->with('error', 'Nomor Surat sudah ada');
            }

            // Handle image upload
            if ($request->hasFile('lampiran')) {
                $lampiran = $request->file('lampiran');
                $lampiranName = time() . '_' . $lampiran->getClientOriginalName();
                $lampiran->storeAs('/admin/sporadik', $lampiranName, 'public_custom');
            } else {
                $lampiranName = null;
            }

            $pemilik_lama_id = Hashids::decode($request->pemilik_lama_id)[0];
            $pemilik_baru_id = Hashids::decode($request->pemilik_baru_id)[0];
            $pengajuan_id = Hashids::decode($request->pengajuan_id)[0];

            if($request->aset_id && $request->aset_id != 'input_manual') {
                $aset_id = Hashids::decode($request->aset_id)[0];
                $aset = Aset::findOrFail($aset_id);
                Sporadik::create([
                    'pemilik_lama_id' => $pemilik_lama_id,
                    'pemilik_baru_id' => $pemilik_baru_id,
                    'pengajuan_id' => $pengajuan_id,
                    'no_surat' => $request->no_surat,
                    'tanggal_surat' => $request->tanggal_surat,
                    'jenis_barang' => $aset->jenis_barang,
                    'luas' => $aset->luas,
                    'alamat' => $aset->alamat,
                    'lampiran' => $lampiranName,
                ]);
                Aset::where('id', $aset_id)->update([
                    'warga_id' => $pemilik_baru_id,
                ]);
            } else {
                Sporadik::create([
                    'pemilik_lama_id' => $pemilik_lama_id,
                    'pemilik_baru_id' => $pemilik_baru_id,
                    'pengajuan_id' => $pengajuan_id,
                    'no_surat' => $request->no_surat,
                    'tanggal_surat' => $request->tanggal_surat,
                    'jenis_barang' => $request->jenis_barang,
                    'luas' => $request->luas,
                    'alamat' => $request->alamat,
                    'lampiran' => $lampiranName,
                ]);
            }

            $pengajuan = Pengajuan::find($pengajuan_id);
            $pengajuan->status = 'Diterima';
            $pengajuan->save();

            return redirect()->route('admin.sporadik')->with('success', 'Berhasil membuat surat sporadik');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Server Error'.$th->getMessage())->withInput();;
        }
    }

    public function detail($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $sporadik = Sporadik::with('pengajuan', 'pemilik_lama', 'pemilik_baru')->where('id', $unhashed)->first();

            return view('pages.admin.sporadiks.detail', compact('sporadik'));
        } catch (\Exception $th) {
            return redirect()->route('admin.sporadik')->with('error', 'Server Error').$th->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $sporadik = Sporadik::with('pengajuan', 'pemilik_lama', 'pemilik_baru')->findOrFail($unhashed);
            $asets = Aset::with('warga')->get();
            $aset = Aset::where('jenis_barang', $sporadik->jenis_barang)
                            ->where('luas', $sporadik->luas)
                            ->where('alamat', $sporadik->alamat)
                            ->where('warga_id', $sporadik->pengajuan->warga_id)
                            ->first();
            $aset_id = $aset? $aset->hashid : 'input_manual';
            $pengajuans = Pengajuan::with('warga')->where('jenis_surat', 'sporadik')->where('status', 'Diterima')->get();
            $warga = Warga::with('aset')->get();
            return view('pages.admin.sporadiks.edit', compact('sporadik', 'asets', 'warga', 'pengajuans', 'aset_id'));
        } catch (\Exception $th) {
            return redirect()->route('admin.sporadik')->with('error', 'Server Error'). $th->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $sporadik_id = Hashids::decode($id)[0];
            $sporadik = Sporadik::findOrFail($sporadik_id);

            if(!$sporadik) {
                return redirect()->back()->with('error', 'Surat Sporadik tidak ditemukan');
            }

            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'pemilik_lama_id' => 'required|string',
                'pemilik_baru_id' => 'required|string',
                'pengajuan_id' => 'required|string',
                'no_surat' => 'required|string',
                'tanggal_surat' => ['required', 'date', 'after_or_equal:today'],
                'aset_id' => 'nullable|string',
                'jenis_barang' => 'nullable|string',
                'luas' => 'nullable|string',
                'alamat' => 'nullable|string',
                'lampiran' => 'nullable|file|mimes:pdf',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            }

            if($request->pemilik_lama_id == $request->pemilik_baru_id){
                return redirect()->back()->with('error', 'Pemilik lama dan pemilik baru tidak boleh sama');
            }

            if($request->no_surat != $sporadik->no_surat){
                $surat = Sporadik::where('no_surat', $request->no_surat)->first();

                if ($surat) {
                    return redirect()->back()->with('error', 'Nomor Surat sudah ada');
                }
            }

            // Handle image upload
            if ($request->hasFile('lampiran')) {
                $lampiran = $request->file('lampiran');
                $lampiranName = time() . '_' . $lampiran->getClientOriginalName();
                $lampiran->storeAs('/admin/sporadik', $lampiranName, 'public_custom');
            } else {
                $lampiranName = $sporadik->lampiran;
            }

            $pemilik_lama_id = Hashids::decode($request->pemilik_lama_id)[0];
            $pemilik_baru_id = Hashids::decode($request->pemilik_baru_id)[0];
            $pengajuan_id = Hashids::decode($request->pengajuan_id)[0];

            if($request->aset_id && $request->aset_id != 'input_manual') {
                $aset_id = Hashids::decode($request->aset_id)[0];
                $aset = Aset::findOrFail($aset_id);
                $sporadik->update([
                    'pemilik_lama_id' => $pemilik_lama_id,
                    'pemilik_baru_id' => $pemilik_baru_id,
                    'pengajuan_id' => $pengajuan_id,
                    'no_surat' => $request->no_surat,
                    'tanggal_surat' => $request->tanggal_surat,
                    'jenis_barang' => $aset->jenis_barang,
                    'luas' => $aset->luas,
                    'alamat' => $aset->alamat,
                    'lampiran' => $lampiranName,
                ]);
                Aset::where('id', $aset_id)->update([
                    'warga_id' => $pemilik_baru_id,
                ]);
            } else {
                $sporadik->update([
                    'pemilik_lama_id' => $pemilik_lama_id,
                    'pemilik_baru_id' => $pemilik_baru_id,
                    'pengajuan_id' => $pengajuan_id,
                    'no_surat' => $request->no_surat,
                    'tanggal_surat' => $request->tanggal_surat,
                    'jenis_barang' => $request->jenis_barang,
                    'luas' => $request->luas,
                    'alamat' => $request->alamat,
                    'lampiran' => $lampiranName,
                ]);
            }

            return redirect()->route('admin.sporadik')->with('success', 'Berhasil memperbarui surat Sporadik');
        } catch (\Exception $th) {
            return redirect()->route('admin.sporadik')->with('error', 'Server Error'.$th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $Sporadik = Sporadik::findOrFail($unhashed);
            $pengajuan = Pengajuan::find($Sporadik->pengajuan_id);
            $pengajuan->status = 'Diproses';
            $pengajuan->save();
            $Sporadik->delete();
            return redirect()->route('admin.sporadik')->with('success', 'Berhasil menghapus surat Sporadik');
        } catch (\Throwable $th) {
            return redirect()->route('admin.sporadik')->with('error', 'Server Error');
        }
    }
}
