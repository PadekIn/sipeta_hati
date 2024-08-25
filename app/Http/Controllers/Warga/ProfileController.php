<?php

namespace App\Http\Controllers\Warga;

use App\Models\Warga;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        return view('pages.warga.profile.index');
    }

    public function edit(Request $request): View
    {
        $id = Auth::user()->warga->id;
        $warga = Warga::find($id);
        return view('pages.warga.profile.edit', compact('warga'));
    }

    public function update(Request $request): RedirectResponse
    {
        try {
            $id = Auth::user()->warga->id;

            $validator = Validator::make($request->all(), [
                'nama' => ['required', 'string', 'max:50'],
                'jenis_kelamin' => ['required', 'string', 'in:laki-laki,perempuan'],
                'no_telp' => ['required', 'string', 'max:15'],
                'alamat' => ['required', 'string', 'max:255'],
                'tanggal_lahir' => ['required', 'date'],
                'lampiran' => 'nullable|mimes:pdf',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            }

            $warga = Warga::findOrFail($id);

            // Handle file upload
            if ($request->hasFile('lampiran')) {
                $lampiran = $request->file('lampiran');
                $lampiranName = time() . '_' . $lampiran->getClientOriginalName();
                $lampiran->storeAs('/warga/data', $lampiranName, 'public_custom');
            } else {
                $lampiranName = $warga->lampiran;
            }

            $warga->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'lampiran' => $lampiranName,
            ]);

            return redirect()->route('profile')->with('success', 'Berhasil memperbarui data profile');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Server Error, gagal memperbarui profile: ' . $e->getMessage());
        }
    }
}
