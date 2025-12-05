<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class ProfileController extends Controller
{
    public function index() {
    return view('profile.index', [
        'tab' => 'biodata'
    ]);
}

public function addresses()
{
    $addresses = auth()->user()->addresses ?? [];

    return view('profile.index', [
        'tab' => 'addresses',
        'addresses' => $addresses
    ]);
}


public function payments() {
    return view('profile.index', [
        'tab' => 'payments'
    ]);
}

public function bank() {
    return view('profile.index', [
        'tab' => 'bank'
    ]);
}

public function notifications() {
    return view('profile.index', [
        'tab' => 'notifications'
    ]);
}

public function security() {
    return view('profile.index', [
        'tab' => 'security'
    ]);
}


    public function update(Request $req)
    {
        $req->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $user = auth()->user();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->save();

        return back()->with('success','Profil berhasil diperbarui!');
    }

    public function becomeSeller()
    {
        $user = auth()->user();
        $user->role = 'seller';
        $user->save();

        return redirect()->route('seller.dashboard')
            ->with('success','Selamat! Anda sekarang adalah Seller.');
    }
}
