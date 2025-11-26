<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierConfirmController extends Controller
{
    public function confirm(Request $request, $id)
    {
        $supplyRequest = \App\Models\SupplyRequest::find($id);
        if (!$supplyRequest) {
            return redirect()->back()->with('error', 'Yêu cầu không tồn tại.');
        }

        // Chỉ nhà cung cấp đúng mới được xác nhận
        $supplier = auth()->user();
        if ($supplier->id != $supplyRequest->supplier_id) {
            return redirect()->back()->with('error', 'Bạn không có quyền xác nhận yêu cầu này.');
        }

        $supplyRequest->status = 'confirmed';
        $supplyRequest->save();

        // Gửi thông báo cho nhân viên
        $user = \App\Models\User::find($supplyRequest->user_id);
        if ($user) {
            // Sử dụng notification của Laravel
            $user->notify(new \App\Notifications\SupplyConfirmedNotification($supplyRequest));
        }

        return redirect()->back()->with('success', 'Đã xác nhận gửi hàng cho yêu cầu này.');
    }
}
