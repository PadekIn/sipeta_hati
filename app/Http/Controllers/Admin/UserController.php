<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
// use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

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
                'role' => 'admin',
                'status' => 1
            ]);

            return redirect()->route('admin.user')->with('success', 'Data Admin berhasil ditambahkan');
        } catch (\Throwable $th) {
            // Tangani error lain yang tidak terkait validasi
            return redirect()->back()->with('error', 'Server Error, data Admin gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $validId = Hashids::decode($id)[0];
        $admin = User::findOrFail($validId);

        return view('pages.admin.users.edit', compact('admin'));
    }

    public function updatePass(Request $request, $id)
    {
        try {
            $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);

            $validId = Hashids::decode($id)[0];
            $user = User::findOrFail($validId);

            if (!Hash::check($validated['current_password'], $user->password)) {
                return redirect()->back()->with('error', 'Kata sandi lama tidak sesuai');
            }

            $user->update([
                'password' => Hash::make($validated['password']),
            ]);

            return redirect()->route('admin.user')->with('success', 'Berhasil mengubah kata sandi Admin');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah kata sandi Admin: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Decode the hash ID
            $validId = Hashids::decode($id);

            // Check if decoding was successful
            if (empty($validId)) {
                return redirect()->back()->with('error', 'Invalid ID');
            }

            // Validate request data
            $request->validate([
                'role' => ['required', 'string', 'max:25'],
                'status' => ['required', 'integer', 'between:0,1'],
            ]);

            // Find the user
            $user = User::findOrFail($validId[0]);

            // Check if there are any changes
            if ($request->role == $user->role && $request->status == $user->status) {
                return redirect()->back()->with('error', 'Tidak ada perubahan data');
            }

            // Update the user's data
            $user->update([
                'role' => $request->role,
                'status' => $request->status,
            ]);

            // Redirect with success message
            return redirect()->route('admin.user')->with('success', 'Berhasil mengubah data Admin');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah data Admin: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $validId = Hashids::decode($id)[0];

            $user = User::findOrFail($validId);
            $user->delete();

            return redirect()->back()->with('success', 'Berhasil menghapus Admin');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus Admin: ' . $e->getMessage());
        }
    }
}
