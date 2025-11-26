<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplyRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để gửi yêu cầu.');
        }

        // Lấy nhà cung cấp của sản phẩm (giả sử có trường supplier_id trong bảng products)
        $product = \App\Models\Product::find($request->product_id);
        $supplier_id = $product->supplier_id ?? null;

        if (!$supplier_id) {
            return redirect()->back()->with('error', 'Sản phẩm chưa có nhà cung cấp.');
        }

        \App\Models\SupplyRequest::create([
            'user_id' => $user->id,
            'supplier_id' => $supplier_id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'status' => 'pending',
            'note' => $request->note ?? null,
        ]);

        return redirect()->back()->with('success', 'Đã gửi yêu cầu nhập hàng cho nhà cung cấp.');
    }
}
