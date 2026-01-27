<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required',
            'receiver' => 'required',
            'phone' => 'required',
            'full_address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_primary'] = $request->is_primary ? 1 : 0;

        Address::create($validated);

        return redirect()->back()->with('success', 'Alamat berhasil ditambahkan!');
    }
}
