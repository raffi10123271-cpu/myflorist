<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ShippingController extends Controller
{
    public function updateShippingStatus(Request $req, $id)
    {
        $req->validate([
            'status' => 'required|string'
        ]);

        $order = Order::where('seller_id', auth()->id())->findOrFail($id);
        $order->shipping_status = $req->status;
        $order->save();

        return back()->with('success', 'Status pengiriman diperbarui.');
    }
}
