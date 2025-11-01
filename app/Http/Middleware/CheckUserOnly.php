<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserOnly
{
    /**
     * Handle an incoming request.
     * Middleware untuk memastikan HANYA user yang bisa akses (admin TIDAK boleh)
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if admin is logged in (admin tidak boleh akses)
        if (session('admin_id') && !session('user_id')) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak dapat mengakses halaman ini. Silakan gunakan akun user.');
        }
        
        // Cek apakah user sudah login
        if (!session('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai user untuk mengakses halaman ini.');
        }
        
        // Jika sudah login sebagai user, boleh akses
        return $next($request);
    }
}
