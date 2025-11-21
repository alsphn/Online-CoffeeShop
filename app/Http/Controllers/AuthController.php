<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login user (admin/member)
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login
        if (Auth::attempt($credentials)) {

            // regenerate session untuk keamanan
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role_id
            if ($user->role_id == 1) {
                return redirect()->route('admin.dashboard');
            }
            if ($user->role_id == 2) {
                return redirect()->route('member.dashboard');
            }

            // fallback
            return redirect()->route('home');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
