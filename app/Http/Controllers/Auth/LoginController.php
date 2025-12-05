<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // TAMPILKAN HALAMAN LOGIN
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // PROSES LOGIN
    public function login(Request $request)
    {
        // VALIDASI INPUT
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // LOGIN PAKAI EMAIL ATAU NO HP
        $credentials = [
            filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone' => $request->email,
            'password' => $request->password
        ];

        // COBA LOGIN
        if (Auth::attempt($credentials, $request->remember)) {

            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        // GAGAL LOGIN
        return back()->withErrors([
            'email' => 'Email / Nomor HP atau Password salah.',
        ]);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
