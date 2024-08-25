<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Warga;
use App\Models\Karyawan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('pages.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'nik' => ['required', 'string', 'max:16', 'unique:'.User::class],
            'nama' => ['required', 'string', 'max:50'],
            'jenis_kelamin' => ['required', 'string', 'in:laki-laki,perempuan'],
            'no_telp' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'lampiran' => 'required|mimes:pdf',
            'password' => ['required', Rules\Password::defaults()],
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
            $lampiran->storeAs('/warga/data', $lampiranName, 'public_custom');
        } else {
            $lampiranName = null;
        }

        // Create and save the event
        try {
            $user = User::create([
                'nik' => $request->input('nik'),
                'password' => Hash::make($request->input('password')),
                'role' => 'warga',
                'status' => 0,
            ]);

            Warga::create([
                'user_id' => $user->id,
                'nama' => $request->input('nama'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'no_telp' => $request->input('no_telp'),
                'alamat' => $request->input('alamat'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'lampiran' => $lampiranName,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Server error, gagal menambahkan data.'. $e->getMessage())
                            ->withInput();
        }

        // Redirect to a named route
        return redirect()->route('login')->with('success', 'Berhasil mendaftar. Harap menunggu validasi dari admin. Max 1x24 jam.');
    }

}
