<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KomtingAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if ($user->role !== 'Komting') {
            Auth::logout();
            Session::flash('error', 'Akses ditolak. Halaman ini hanya untuk Komting Kelas.');
            return redirect()->route('login');
        }

        // Check if the komting account is active, and has assigned class
        $komtingKelas = $user->komtingKelas;
        if (!$komtingKelas || $komtingKelas->status !== 'Aktif') {
            Auth::logout();
            Session::flash('error', 'Akun Komting Anda dinonaktifkan atau belum memiliki kelas yang ditugaskan.');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
