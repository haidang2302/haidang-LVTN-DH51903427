<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryProductController extends Controller
{
    public function index()
    {
        // Lấy tất cả category cùng với sản phẩm của từng category
        $categories = Category::with('products')->get();
        $category = $categories->first();
        return view('category_products', compact('categories', 'category'));
    }

    public function showCategory($id)
    {
        $category = Category::with('products')->findOrFail($id);
        $categories = Category::all();
        return view('category_products', compact('category', 'categories'));
    }
}
