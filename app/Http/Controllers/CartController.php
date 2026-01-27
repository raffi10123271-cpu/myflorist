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

        return view('cart.index', compact('items'));
    }

    public function add(Request $req)
    {
        $req->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        Cart::updateOrCreate(
            [
                'user_id'    => auth()->id(),
                'product_id' => $req->product_id
            ],
            [
                'quantity' => \DB::raw('quantity + 1')
            ]
        );

        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function remove(Request $req)
    {
        Cart::where('user_id', auth()->id())
            ->where('product_id', $req->product_id)
            ->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }
}
