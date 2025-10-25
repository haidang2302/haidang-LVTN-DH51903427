<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoDataController extends Controller
{
    public function dashboard()
    {
        $users = [
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@example.com'],
            ['id' => 2, 'name' => 'User', 'email' => 'user@example.com'],
        ];
        $categories = [
            ['id' => 1, 'name' => 'Áo Nữ'],
            ['id' => 2, 'name' => 'Áo Nam'],
        ];
        $products = [
            ['id' => 1, 'name' => 'Áo Len Nữ', 'category_id' => 1, 'price' => 400000],
            ['id' => 2, 'name' => 'Áo Thun Nam', 'category_id' => 2, 'price' => 250000],
        ];
        $templates = [
            ['id' => 1, 'name' => 'Template Áo Nữ'],
            ['id' => 2, 'name' => 'Template Áo Nam'],
        ];
        return view('admin.dashboard', compact('users', 'categories', 'products', 'templates'));
    }

    public function showLogin() {
        return view('login-demo');
    }

    public function doLogin(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        if ($email === 'admin@example.com' && $password === 'password') {
            return redirect('/dashboard-demo')->with('success', 'Đăng nhập thành công!');
        }
        return back()->with('error', 'Sai thông tin đăng nhập!');
    }
}
