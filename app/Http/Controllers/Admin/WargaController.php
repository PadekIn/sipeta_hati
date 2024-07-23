<?php

namespace App\Http\Controllers\Admin;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WargaController extends Controller
{
    public function index()
    {
        $warga = Warga::all();
        return view('pages.admin.warga.list', compact('warga'));
    }

    public function create()
    {
        return view('pages.admin.warga.create');
    }

    public function createBio()
    {
        return view('pages.admin.warga.bio');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        Warga::create($request->all());
        return redirect()->route('warga.index');
    }

    public function edit(Warga $warga)
    {
        return view('pages.admin.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        $warga->update($request->all());
        return redirect()->route('warga.index');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index');
    }
}
