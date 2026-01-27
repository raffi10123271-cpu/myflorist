<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $sellerId = auth()->id();

        return view('seller.dashboard', [
            'total_products' => Product::where('user_id', $sellerId)->count(),
            'total_orders'   => Order::where('seller_id', $sellerId)->count(),
            'pending_orders' => Order::where('seller_id', $sellerId)->where('status', 'pending')->count(),
        ]);
    }
}
