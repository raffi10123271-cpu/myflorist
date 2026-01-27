<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SellerProfile;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'pending_sellers' => SellerProfile::whereHas('user', function($q){
                $q->where('seller_status', 'pending');
            })->count(),
            'total_sellers' => User::where('role', 'seller')->count(),
            'total_users' => User::count(),
        ]);
    }

    public function sellers()
    {
        return view('admin.sellers', [
            'sellers' => SellerProfile::with('user')->get()
        ]);
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->seller_status = 'active';
        $user->role = 'seller';
        $user->save();

        return back()->with('success', 'Seller berhasil diverifikasi.');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->seller_status = 'rejected';
        $user->save();

        return back()->with('success', 'Seller ditolak.');
    }
}
