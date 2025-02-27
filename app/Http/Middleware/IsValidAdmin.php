<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsValidAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Pastikan pengguna telah terautentikasi
        if (!$user) {
            return redirect()->route('login'); // Redirect ke halaman login jika tidak terautentikasi
        }

        // Lanjutkan dengan logika middleware kustom
        if ($user->status === false) {
            return redirect()->route('logout');
        }

        // Lanjutkan dengan logika middleware kustom
        if ($user->role === 'warga') {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
