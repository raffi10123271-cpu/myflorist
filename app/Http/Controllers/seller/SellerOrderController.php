<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;

class SellerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('seller_id', auth()->id())->get();
        return view('seller.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('seller_id', auth()->id())->findOrFail($id);
        return view('seller.orders.show', compact('order'));
    }
}
