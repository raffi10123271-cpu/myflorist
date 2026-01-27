<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User dihapus!');
    }

    public function sellerRequests()
{
    $users = User::where('seller_status', 'pending')->get();
    return view('admin.seller.requests', compact('users'));
}

public function approveSeller($id)
{
    User::where('id', $id)->update(['seller_status' => 'approved']);
    return back()->with('success', 'Seller berhasil disetujui!');
}

public function rejectSeller($id)
{
    User::where('id', $id)->update(['seller_status' => 'rejected']);
    return back()->with('success', 'Seller ditolak.');
}

}

    