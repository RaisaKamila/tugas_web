<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //menampilkan halaman login
    public function showLoginForm()
    {
        if (session()->has('user')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    //menampilkan halaman register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'password' => $request->password, // Akan di-hash otomatis oleh model
            'role' => 'user',
        ]);

        return redirect()->route('login'); // Arahkan ke halaman login setelah registrasi
    }

    //logika login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && $user->password === md5($request->password)) {
            Auth::login($user);
            session(['user' => $user]); 
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    //logika logout
    public function logout()
    {
        session()->flush(); 
        Auth::logout();
        session()->invalidate(); 
        session()->regenerateToken(); 
        return redirect()->route('login')->with('message', 'Anda telah logout.');
    }
}    