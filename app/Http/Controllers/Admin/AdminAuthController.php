<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Cek user & admin role
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin'  // hanya admin boleh login
        ])) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah, atau Anda bukan admin.'
        ]);
    }
}
