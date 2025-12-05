<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with('images', 'seller')
            ->firstOrFail();

        return view('product.show', compact('product'));
    }
}
