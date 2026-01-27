<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SellerProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id', auth()->id())->get();
        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        return view('seller.products.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'description' => 'required',
            'image'       => 'image|max:2048'
        ]);

        Product::create([
            'user_id'     => auth()->id(),
            'name'        => $req->name,
            'price'       => $req->price,
            'description' => $req->description,
            'image'       => $req->image?->store('products'),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return view('seller.products.edit', compact('product'));
    }

    public function update(Request $req, Product $product)
    {
        $this->authorize('update', $product);

        $req->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'description' => 'required',
            'image'       => 'image|max:2048'
        ]);

        $product->update([
            'name'        => $req->name,
            'price'       => $req->price,
            'description' => $req->description,
            'image'       => $req->image ? $req->image->store('products') : $product->image,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}
