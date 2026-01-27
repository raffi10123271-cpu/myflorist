<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'login'    => 'required',
        'password' => 'required',
    ]);

    $login = $request->login;

    // DETEKSI FIELD YANG DIPAKAI LOGIN
    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $field = 'email';
    } elseif (is_numeric($login)) {
        $field = 'phone';
    } else {
        $field = 'username';
    }

    // LOGIN
    if (Auth::attempt([$field => $login, 'password' => $request->password])) {

        // Jika admin → redirect admin panel
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // User biasa
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'login' => "Login gagal! $field tidak cocok atau password salah.",
    ]);
}


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
