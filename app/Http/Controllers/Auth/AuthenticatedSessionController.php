<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('pages.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
       try{
            $isUser = User::where('nik', $request->nik)->where('status', true)->first();

            if(!$isUser){
                return redirect()->back()
                                ->with('error', 'Akun anda belum aktif, silahkan hubungi admin.');
            }

            $request->authenticate();
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role==="admin") {
                return redirect()->intended(route('admin.dashboard', absolute: false));
            } elseif ($user->role==="warga") {
                return redirect()->intended(route('dashboard', absolute: false));
            } else {
                return redirect()->intended(route('login'));
            }
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Server error, gagal menambahkan data.'. $e->getMessage());

        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
