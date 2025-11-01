<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminAuth
{
    /**
     * Handle an incoming request.
     * Middleware untuk memastikan hanya ADMIN yang bisa akses admin panel
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika tidak ada session admin_id, redirect ke login admin
        if (!session('admin_id')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login sebagai admin terlebih dahulu.');
        }
        
        // Jika ada session user_id (user galeri) tapi TIDAK ada admin_id, redirect ke galeri
        // Tapi jika admin_id ada, biarkan admin akses panel admin (meskipun ada user_id)
        if (session('user_id') && session('user_type') === 'user' && !session('admin_id')) {
            return redirect()->route('gallery.galeri')->with('error', 'User galeri tidak dapat mengakses panel admin.');
        }
        
        return $next($request);
    }
}
