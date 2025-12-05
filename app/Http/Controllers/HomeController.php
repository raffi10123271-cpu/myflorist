<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->latest()->take(12)->get();
        $categories = Category::all();

        return view('home', compact('products','categories'));
    }
}
