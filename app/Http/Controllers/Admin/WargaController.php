<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

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

    public function detail($id)
    {
        $validId = Hashids::decode($id)[0];
        $warga = Warga::findOrFail($validId);

        return view('pages.admin.warga.detail', compact('warga'));
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'nik' => 'required|unique:users,nik',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20', // You can customize the validation rules based on your needs
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
        ], [
            'nik.unique' => 'NIK ini sudah terdaftar. Silakan gunakan NIK yang berbeda.',
            'password.confirmed' => 'Konfirmasi password tidak sama dengan password yang dimasukkan.',
        ]);

        try {
            $user = User::create([
                'nik' => $request->nik,
                'password' => Hash::make($request->password),
                'role' => 'warga',
                'status' => 1
            ]);
            Warga::create([
                'user_id' => $user->id,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir
            ]);
            
            return redirect()->route('admin.warga')->with('success', 'Data Warga berhasil ditambahkan');
        } catch (\Throwable $th) {
            // Tangani error lain yang tidak terkait validasi
            return redirect()->back()->with('error', 'Server Error, data Warga gagal ditambahkan');
        }

    }

    public function edit($id)
    {
        $validId = Hashids::decode($id)[0];
        $warga = Warga::findOrFail($validId);
        return view('pages.admin.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $validId = Hashids::decode($id)[0];
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
        ]);

        try {
            $warga = Warga::findOrFail($validId);

            $warga->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir
            ]);

            return redirect()->route('admin.warga.detail', $warga->hashId)->with('success', 'Data Warga berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah data Warga: ' . $e->getMessage());
        }
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index');
    }
}
