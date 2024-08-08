<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController
{
    public function index()
    {
        $admin = User::where('role', 'admin')->get();
        return view('pages.admin.users.list', compact('admin'));
    }

    public function create()
    {
        return view('pages.admin.users.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        // Validasi data
        $request->validate([
            'nik' => 'required|unique:users,nik',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'nik.unique' => 'NIK ini sudah terdaftar. Silakan gunakan NIK yang berbeda.',
            'password.confirmed' => 'Konfirmasi password tidak sama dengan password yang dimasukkan.',
        ]);
    
        // Jika validasi lolos, lanjutkan ke operasi berikutnya
        try {
            User::create([
                'nik' => $request->nik,
                'password' => Hash::make($request->password),
                'role' => 'warga',
                'status' => 1
            ]);
    
            return redirect()->back()->with('success', 'Data Admin berhasil ditambahkan');
        } catch (\Throwable $th) {
            // Tangani error lain yang tidak terkait validasi
            return redirect()->back()->with('error', 'Server Error, data Admin gagal ditambahkan');
        }
    }


    public function edit($id)
    {
        return view('pages.admin.users.edit');
    }

    public function update(Request $request, $id)
    {
        // update user
    }

    public function destroy($id)
    {
        // delete user
    }
}
