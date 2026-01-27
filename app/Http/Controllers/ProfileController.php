<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class ProfileController extends Controller
{
    public function index($tab)
    {
        $allowedTabs = [
            'biodata', 'addresses', 'payments', 'bank', 'notifications', 'security'
        ];

        if (!in_array($tab, $allowedTabs)) {
            return redirect()->route('profile.tab', 'biodata');
        }

        $user = auth()->user();

        return view('profile.index', [
            'tab'       => $tab,
            'user'      => $user,
            'addresses' => $user->addresses ?? [],
            'payments'  => $user->payments ?? [],
            'banks'     => $user->banks ?? [],
        ]);
    }


    /* ============================================================
    |  BIODATA UPDATE
    ============================================================ */
    public function update(Request $req)
    {
        $req->validate([
            'name'  => 'required|string',
            'email' => 'required|email',
        ]);

        auth()->user()->update($req->only('name', 'email'));

        return back()->with('success', 'Profil berhasil diperbarui!');
    }


    /* ============================================================
    |  SELLER APPLY
    ============================================================ */
    public function becomeSeller()
    {
        $user = auth()->user();

        if ($user->seller_status !== 'none') {
            return back()->with('info', 'Anda sudah mengajukan pendaftaran seller.');
        }

        $user->seller_status = 'pending';
        $user->save();

        return back()->with('success', 'Pengajuan seller dikirim. Menunggu verifikasi admin.');
    }


    /* ============================================================
    |  ADDRESS ADD FORM
    ============================================================ */
    public function addAddress()
    {
        return view('profile.tabs.address_add');
    }


    /* ============================================================
    |  ADDRESS STORE
    ============================================================ */
    public function storeAddress(Request $request)
{
    $request->validate([
        'label' => 'required',
        'receiver' => 'required',
        'phone' => 'required',
        'full_address' => 'required',
        'city' => 'required',
        'province' => 'required',
        'postal_code' => 'required',
    ]);

    \App\Models\Address::create([
        'user_id'      => auth()->id(),
        'label'        => $request->label,
        'receiver'     => $request->receiver,
        'phone'        => $request->phone,
        'full_address' => $request->full_address,
        'city'         => $request->city,
        'province'     => $request->province,
        'postal_code'  => $request->postal_code,
        'is_primary'   => 0,  // default
    ]);

    return redirect('/profile/addresses')
        ->with('success', 'Alamat berhasil ditambahkan!');
}

}
