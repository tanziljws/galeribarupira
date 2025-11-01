<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserAuth
{
    /**
     * Handle an incoming request.
     * Middleware untuk memastikan user sudah login (user atau admin bisa akses)
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah ada session user_id ATAU admin_id
        $isLoggedIn = session('user_id') || session('admin_id');
        
        // Jika tidak ada session sama sekali, redirect ke login user
        if (!$isLoggedIn) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
        }
        
        // Jika sudah login (baik user atau admin), boleh akses
        return $next($request);
    }
}
