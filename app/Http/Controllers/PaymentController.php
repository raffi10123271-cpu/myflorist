<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function uploadProof(Request $req, $id)
    {
        $req->validate([
            'proof' => 'required|image|max:2048'
        ]);

        $order = Order::where('user_id', auth()->id())->findOrFail($id);

        $path = $req->file('proof')->store('uploads/payments','public');

        $order->payment->update([
            'proof' => 'storage/'.$path,
            'status' => 'waiting_verification'
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diupload!');
    }
}
