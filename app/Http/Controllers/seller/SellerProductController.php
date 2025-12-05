<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SellerProductController extends Controller
{
    public function index()
    {
        $products = Product::where('seller_id', auth()->id())->with('images')->get();
        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        return view('seller.products.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'images.*' => 'image|max:2048'
        ]);

        $product = Product::create([
            'seller_id' => auth()->id(),
            'title' => $req->title,
            'slug' => Str::slug($req->title),
            'price' => $req->price,
            'stock' => $req->stock,
            'description' => $req->description
        ]);

        if ($req->hasFile('images')) {
            foreach ($req->file('images') as $img) {
                $path = $img->store('uploads/products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => 'storage/'.$path
                ]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        if ($product->seller_id !== auth()->id()) {
            abort(403);
        }

        return view('seller.products.edit', compact('product'));
    }

    public function update(Request $req, Product $product)
    {
        if ($product->seller_id !== auth()->id()) {
            abort(403);
        }

        $product->update([
            'title' => $req->title,
            'price' => $req->price,
            'stock' => $req->stock,
            'description' => $req->description
        ]);

        return back()->with('success', 'Produk diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->seller_id !== auth()->id()) {
            abort(403);
        }

        $product->delete();
        return back()->with('success', 'Produk dihapus!');
    }
}
