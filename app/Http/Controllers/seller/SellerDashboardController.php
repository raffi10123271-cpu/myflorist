<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::where('seller_id', auth()->id())->count();
        $totalStock = Product::where('seller_id', auth()->id())->sum('stock');

        return view('seller.dashboard', compact('productCount', 'totalStock'));
    }
}
