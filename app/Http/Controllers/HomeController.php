<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'products'   => Product::latest()->limit(12)->get(),
            'categories' => Category::all(),
        ]);
    }
}
