<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PortalMahasiswaAuth
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
        if (!Session::has('portal_mahasiswa_id')) {
            Session::flash('error', 'Silakan masuk terlebih dahulu untuk mengakses Portal Mahasiswa.');
            return redirect()->route('portal-mahasiswa.login');
        }

        return $next($request);
    }
}
