<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function updateShippingStatus(Request $req, $id)
    {
        $req->validate([
            'shipping_status' => 'required',
        ]);

        $order = Order::findOrFail($id);

        if ($order->items->first()->product->seller_id != auth()->id()) {
            abort(403);
        }

        $order->update([
            'shipping_status' => $req->shipping_status,
        ]);

        return back()->with('success', 'Status pengiriman diperbarui!');
    }
}
