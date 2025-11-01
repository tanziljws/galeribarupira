<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in (user tidak boleh akses admin)
        if (session('user_id') && !session('admin_id')) {
            return redirect()->route('gallery.beranda')->with('error', 'Anda tidak memiliki akses ke halaman admin');
        }
        
        // Check if admin is logged in
        if (!session('admin_id')) {
            // Admin not logged in, redirect to admin login
            return redirect()->route('admin.login')->with('error', 'Silakan login sebagai admin terlebih dahulu');
        }
        
        return $next($request);
    }
}
