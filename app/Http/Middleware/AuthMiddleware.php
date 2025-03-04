<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Memeriksa apakah pengguna sudah login
        if (!Session::has('user_id')) {
            return redirect('/login'); // Mengarahkan ke halaman login jika belum login
        }

        return $next($request);
    }
}