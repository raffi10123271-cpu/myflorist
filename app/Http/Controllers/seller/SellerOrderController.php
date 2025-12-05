<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class SellerOrderController extends Controller
{
    public function index()
    {
        // Ambil order yang memiliki produk dari seller
        $orders = Order::whereHas('items.product', function ($q) {
            $q->where('seller_id', auth()->id());
        })
        ->with('items.product', 'payment')
        ->orderBy('id', 'DESC')
        ->get();

        return view('seller.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::whereHas('items.product', function ($q) {
            $q->where('seller_id', auth()->id());
        })
        ->with('items.product', 'payment', 'address', 'user')
        ->findOrFail($id);

        return view('seller.orders.show', compact('order'));
    }
}
