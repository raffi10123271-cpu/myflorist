<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellerProfile;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function dashboard()
    {
        return view('seller.dashboard');
    }

    public function registerForm()
    {
        return view('seller.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'store_name' => 'required',
            'store_phone' => 'required',
            'store_address' => 'required',
            'store_description' => 'nullable',
            'store_logo' => 'nullable|image'
        ]);

        $data = $request->only([
            'store_name',
            'store_phone',
            'store_address',
            'store_description'
        ]);

        if ($request->hasFile('store_logo')) {
            $data['store_logo'] = $request->file('store_logo')->store('store_logos', 'public');
        }

        $data['user_id'] = Auth::id();

        // Simpan ke tabel seller_profiles
        SellerProfile::create($data);

        // Update status seller_user
        Auth::user()->update([
            'seller_status' => 'pending'
        ]);

        return redirect()->route('profile.tab', 'biodata')
            ->with('success', 'Pendaftaran seller berhasil! Menunggu verifikasi admin.');
    }
}
