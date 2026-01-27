<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name'     => 'required',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:6',
        'phone'    => 'nullable|unique:users',
    ]);

    $username = strtolower(str_replace(' ', '', $request->name));

    // Jika username sudah dipakai, tambahkan angka unik
    $count = \App\Models\User::where('username', $username)->count();
    if ($count > 0) {
        $username = $username . ($count + 1);
    }

    $user = User::create([
        'name'        => $request->name,
        'email'       => $request->email,
        'username'    => $username,
        'phone'       => $request->phone,
        'password'    => bcrypt($request->password),
        'role'        => 'customer',
        'seller_status' => 'none'
    ]);

    // auth()->login($user);

    // Arahkan ke halaman login setelah registrasi
    return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
}

    protected function create(array $data)
{
    return User::create([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'username' => $data['username'],
        'phone'    => $data['phone'],
        'password' => bcrypt($data['password']),
        'role'     => 'customer',
    ]);
}


}
