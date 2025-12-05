<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::with('product')
                     ->where('user_id', auth()->id())
                     ->get();

        return view('cart', compact('items'));
    }

    public function add($productId)
    {
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            'quantity' => 1,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
}
