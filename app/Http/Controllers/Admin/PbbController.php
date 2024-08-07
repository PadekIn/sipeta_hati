<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pbb;
use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vinkla\Hashids\Facades\Hashids;

class PbbController extends Controller
{
    public function index()
    {
        try {
            $pbbs = Pbb::with('aset', 'user')->get();
            return view('pages.admin.pbb.list', compact('pbbs'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Server Error');
        }
    }

    public function create()
    {
        try {
            $asets = Aset::all();
            return view('pages.admin.pbb.create', compact('asets'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.pbb')->with('error', 'Server Error');
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'aset_id' => 'required|string',
                'no_surat' => 'required|string',
                'tanggal_surat' => 'required|date',
                'perihal' => 'required|string',
                'keterangan' => 'required|string',
            ]);

            $aset_id = Hashids::decode($validatedData['aset_id'])[0];
            $user_id = auth()->user()->id;

            $surat = Pbb::where('no_surat', $validatedData['no_surat'])->first();

            if ($surat) {
                return redirect()->route('pbb.create')->with('error', 'Nomor Surat sudah ada');
            }

            Pbb::create([
                'aset_id' => $aset_id,
                'user_id' => $user_id,
                'no_surat' => $validatedData['no_surat'],
                'tanggal_surat' => $validatedData['tanggal_surat'],
                'perihal' => $validatedData['perihal'],
                'keterangan' => $validatedData['keterangan'],
            ]);

            return redirect()->route('admin.pbb')->with('success', 'Berhasil membuat surat PBB');
        } catch (\Exception $th) {
            return redirect()->route('admin.pbb')->with('error', 'Server Error'.$th->getMessage());
        }
    }

    public function detail($id)
    {
        try {
            $unhashed = Hashids::decode($id);
            $pbb = Pbb::with('aset', 'user')->where('id', $unhashed)->first();

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
            $pbb = Pbb::with('aset')->findOrFail($unhashed);
            $asets = Aset::with('warga')->get();
            return view('pages.admin.pbb.edit', compact('pbb', 'asets'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.pbb')->with('error', 'Server Error');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'aset_id' => 'required|string',
                'no_surat' => 'required|string',
                'tanggal_surat' => 'required|date',
                'perihal' => 'required|string',
                'keterangan' => 'required|string',
            ]);

            $aset_id = Hashids::decode($validatedData['aset_id'])[0];
            $user_id = auth()->user()->id;

            $surat = Pbb::where('no_surat', $validatedData['no_surat'])->first();

            if ($surat) {
                return redirect()->back()->with('error', 'Nomor Surat sudah ada');
            }

            $unhashed = Hashids::decode($id)[0];
            $pbb = Pbb::findOrFail($unhashed);
            $pbb->update([
                'aset_id' => $aset_id,
                'user_id' => $user_id,
                'no_surat' => $validatedData['no_surat'],
                'tanggal_surat' => $validatedData['tanggal_surat'],
                'perihal' => $validatedData['perihal'],
                'keterangan' => $validatedData['keterangan'],
            ]);

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
            $pbb->delete();
            return redirect()->route('admin.pbb')->with('success', 'Berhasil menghapus surat PBB');
        } catch (\Throwable $th) {
            return redirect()->route('admin.pbb')->with('error', 'Server Error');
        }
    }
}
