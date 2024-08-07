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

    public function show($id)
    {
        // Retrieve the PBB record with the given ID from the database
        $pbb = Pbb::findOrFail($id);

        // Return the view with the retrieved PBB record
        return view('pages.admin.pbb.show', compact('pbb'));
    }

    public function edit($id)
    {
        // Retrieve the PBB record with the given ID from the database
        // $pbb = Pbb::findOrFail($id);

        // Return the view for editing the PBB record
        return view('pages.admin.pbb.edit');
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // Define your validation rules here
        ]);

        // Retrieve the PBB record with the given ID from the database
        $pbb = Pbb::findOrFail($id);

        // Update the PBB record with the validated data
        $pbb->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('pbb.index')->with('success', 'PBB record updated successfully');
    }

    public function destroy($id)
    {
        // Retrieve the PBB record with the given ID from the database
        $pbb = Pbb::findOrFail($id);

        // Delete the PBB record
        $pbb->delete();

        // Redirect to the index page with a success message
        return redirect()->route('pbb.index')->with('success', 'PBB record deleted successfully');
    }
}
