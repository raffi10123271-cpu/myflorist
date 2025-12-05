<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $req)
    {
        $req->validate(['name' => 'required']);

        Category::create([
            'name' => $req->name,
            'slug' => Str::slug($req->name)
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $req, Category $category)
    {
        $category->update([
            'name' => $req->name,
            'slug' => Str::slug($req->name)
        ]);

        return back()->with('success', 'Kategori diperbarui!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori dihapus!');
    }
}
