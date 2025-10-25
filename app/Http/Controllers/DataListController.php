<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DataListController extends Controller
{
    public function users() {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function categories() {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }
    public function products() {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }
}
