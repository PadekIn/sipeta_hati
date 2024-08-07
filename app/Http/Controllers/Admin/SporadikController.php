<?php

namespace App\Http\Controllers\Admin;

use App\Models\Aset;
use App\Models\Warga;
use App\Models\Sporadik;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vinkla\Hashids\Facades\Hashids;

class SporadikController extends Controller
{
    public function index()
    {
        try {
            $sporadiks = Sporadik::with('aset', 'pemilik_lama', 'pemilik_baru')->get();
            return view('pages.admin.sporadiks.list', compact('sporadiks'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Server Error'. $th->getMessage());
        }
    }

    public function create()
    {
        try {
            $asets = Aset::with('warga')->get();
            $warga = Warga::with('aset')->get();
            return view('pages.admin.sporadiks.create', compact('asets', 'warga'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.sporadik')->with('error', 'Server Error');
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'pemilik_lama_id' => 'required|string',
                'pemilik_baru_id' => 'required|string',
                'aset_id' => 'required|string',
                'no_surat' => 'required|string',
                'jenis_surat' => 'required|string',
                'tanggal_surat' => 'required|date',
            ]);

            $pemilik_lama_id = Hashids::decode($validatedData['pemilik_lama_id'])[0];
            $pemilik_baru_id = Hashids::decode($validatedData['pemilik_baru_id'])[0];
            $aset_id = Hashids::decode($validatedData['aset_id'])[0];

            $surat = Sporadik::where('no_surat', $validatedData['no_surat'])->first();

            if ($surat) {
                return redirect()->route('sporadik.create')->with('error', 'Nomor Surat sudah ada');
            }

            Aset::where('id', $aset_id)->update([
                'warga_id' => $pemilik_baru_id,
            ]);

            Sporadik::create([
                'pemilik_lama_id' => $pemilik_lama_id,
                'pemilik_baru_id' => $pemilik_baru_id,
                'aset_id' => $aset_id,
                'no_surat' => $validatedData['no_surat'],
                'jenis_surat' => $validatedData['jenis_surat'],
                'tanggal_surat' => $validatedData['tanggal_surat'],
            ]);

            return redirect()->route('admin.sporadik')->with('success', 'Berhasil membuat surat sporadik');
        } catch (\Exception $th) {
            return redirect()->route('admin.sporadik')->with('error', 'Server Error'.$th->getMessage());
        }
    }

    public function detail($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $sporadik = Sporadik::with('aset', 'pemilik_lama', 'pemilik_baru')->where('id', $unhashed)->first();
            // Return the view with the retrieved Sporadik record
            return view('pages.admin.sporadiks.detail', compact('sporadik'));
        } catch (\Exception $th) {
            return redirect()->route('admin.sporadik')->with('error', 'Server Error').$th->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            $unhashed = Hashids::decode($id)[0];
            $sporadik = Sporadik::with('aset',  'pemilik_lama', 'pemilik_baru')->findOrFail($unhashed);
            $asets = Aset::with('warga')->get();
            $warga = Warga::with('aset')->get();
            return view('pages.admin.sporadiks.edit', compact('sporadik', 'asets', 'warga'));
        } catch (\Exception $th) {
            return redirect()->route('admin.sporadik')->with('error', 'Server Error'). $th->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'pemilik_lama_id' => 'required|string',
                'pemilik_baru_id' => 'required|string',
                'aset_id' => 'required|string',
                'no_surat' => 'required|string',
                'jenis_surat' => 'required|string',
                'tanggal_surat' => 'required|date',
            ]);

            $pemilik_lama_id = Hashids::decode($validatedData['pemilik_lama_id'])[0];
            $pemilik_baru_id = Hashids::decode($validatedData['pemilik_baru_id'])[0];
            $aset_id = Hashids::decode($validatedData['aset_id'])[0];

            $surat = Sporadik::where('no_surat', $validatedData['no_surat'])->first();

            $unhashed = Hashids::decode($id)[0];
            $sporadik = Sporadik::findOrFail($unhashed);
            $sporadik->update([
                'pemilik_lama_id' => $pemilik_lama_id,
                'pemilik_baru_id' => $pemilik_baru_id,
                'aset_id' => $aset_id,
                'no_surat' => $validatedData['no_surat'],
                'jenis_surat' => $validatedData['jenis_surat'],
                'tanggal_surat' => $validatedData['tanggal_surat'],
            ]);

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
            $Sporadik->delete();
            return redirect()->route('admin.sporadik')->with('success', 'Berhasil menghapus surat Sporadik');
        } catch (\Throwable $th) {
            return redirect()->route('admin.sporadik')->with('error', 'Server Error');
        }
    }
}
