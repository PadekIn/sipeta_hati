<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pbb;
use App\Models\Aset;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Validator;

class PbbController extends Controller
{
    public function index()
    {
        try {
            $pbbs = Pbb::with('pengajuan')->get();
            return view('pages.admin.pbb.list', compact('pbbs'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Server Error');
        }
    }

    public function create()
    {
        try {
            $pengajuans = Pengajuan::with('warga')->where('jenis_surat', 'pbb')->where('status', 'Diproses')->get();
            $asets = Aset::with('warga')->get();
            return view('pages.admin.pbb.create', compact('pengajuans', 'asets'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.pbb')->with('error', 'Server Error'.$th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
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

            // Handle image upload
            if ($request->hasFile('lampiran')) {
                $lampiran = $request->file('lampiran');
                $lampiranName = time() . '_' . $lampiran->getClientOriginalName();
                $lampiran->storeAs('/admin/pbb', $lampiranName, 'public_custom');
            } else {
                $lampiranName = null;
            }

            $surat = Pbb::where('no_surat', $request->no_surat)->first();

            if ($surat) {
                return redirect()->route('pbb.create')->with('error', 'Nomor Surat sudah ada');
            }

            $pengajuan_id = Hashids::decode($request->pengajuan_id)[0];

            if($request->aset_id && $request->aset_id != 'input_manual') {
                $aset_id = Hashids::decode($request->aset_id)[0];
                $aset = Aset::findOrFail($aset_id);
                Pbb::create([
                    'pengajuan_id' => $pengajuan_id,
                    'no_surat' => $request->no_surat,
                    'tanggal_surat' => $request->tanggal_surat,
                    'jenis_barang' => $aset->jenis_barang,
                    'luas' => $aset->luas,
                    'alamat' => $aset->alamat,
                    'lampiran' => $lampiranName,
                ]);
            } else {
                Pbb::create([
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

            return redirect()->route('admin.pbb')->with('success', 'Berhasil membuat surat PBB');
        } catch (\Exception $th) {
            return redirect()->route('admin.pbb')->with('error', 'Server Error'.$th->getMessage());
        }
    }

    public function detail($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $pbb = Pbb::with('pengajuan')->where('id', $unhashed)->first();

            // Return the view with the retrieved PBB record
            return view('pages.admin.pbb.detail', compact('pbb'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.pbb')->with('error', 'Server Error');
        }
    }

    public function edit($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $pbb = Pbb::with('pengajuan')->findOrFail($unhashed);
            $asets = Aset::with('warga')->get();
            $aset = Aset::where('jenis_barang', $pbb->jenis_barang)
                            ->where('luas', $pbb->luas)
                            ->where('alamat', $pbb->alamat)
                            ->where('warga_id', $pbb->pengajuan->warga_id)
                            ->first();
            $aset_id = $aset? $aset->hashid : 'input_manual';
            $pengajuans = Pengajuan::with('warga')->where('jenis_surat', 'pbb')->where('status', 'Diterima')->get();
            return view('pages.admin.pbb.edit', compact('pbb', 'asets', 'pengajuans', 'aset_id'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.pbb')->with('error', 'Server Error');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pbb_id = Hashids::decode($id)[0];
            $pbb = Pbb::findOrFail($pbb_id);

            if(!$pbb) {
                return redirect()->back()->with('error', 'Surat PBB tidak ditemukan');
            }

            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
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

            // Handle image upload
            if ($request->hasFile('lampiran')) {
                $lampiran = $request->file('lampiran');
                $lampiranName = time() . '_' . $lampiran->getClientOriginalName();
                $lampiran->storeAs('/admin/pbb', $lampiranName, 'public_custom');
            } else {
                $lampiranName = $pbb->lampiran;
            }

            if($request->no_surat != $pbb->no_surat){
                $surat = Pbb::where('no_surat', $request->no_surat)->first();

                if ($surat) {
                    return redirect()->back()->with('error', 'Nomor Surat sudah ada');
                }
            }

            $pengajuan_id = Hashids::decode($request->pengajuan_id)[0];

            if($request->aset_id && $request->aset_id != 'input_manual') {
                $aset_id = Hashids::decode($request->aset_id)[0];
                $aset = Aset::findOrFail($aset_id);
                $pbb->update([
                    'pengajuan_id' => $pengajuan_id,
                    'no_surat' => $request->no_surat,
                    'tanggal_surat' => $request->tanggal_surat,
                    'jenis_barang' => $aset->jenis_barang,
                    'luas' => $aset->luas,
                    'alamat' => $aset->alamat,
                    'lampiran' => $lampiranName,
                ]);
            } else {
                $pbb->update([
                    'pengajuan_id' => Hashids::decode($request->pengajuan_id)[0],
                    'no_surat' => $request->no_surat,
                    'tanggal_surat' => $request->tanggal_surat,
                    'jenis_barang' => $request->jenis_barang,
                    'luas' => $request->luas,
                    'alamat' => $request->alamat,
                    'lampiran' => $lampiranName,
                ]);
            }

            return redirect()->route('admin.pbb')->with('success', 'Berhasil memperbarui surat PBB');
        } catch (\Exception $th) {
            return redirect()->route('admin.pbb')->with('error', 'Server Error'.$th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $pbb = Pbb::findOrFail($unhashed);
            $pengajuan = Pengajuan::find($pbb->pengajuan_id);
            $pengajuan->status = 'Diproses';
            $pengajuan->save();
            $pbb->delete();
            return redirect()->route('admin.pbb')->with('success', 'Berhasil menghapus surat PBB');
        } catch (\Throwable $th) {
            return redirect()->route('admin.pbb')->with('error', 'Server Error');
        }
    }
}
