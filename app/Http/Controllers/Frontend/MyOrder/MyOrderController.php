<?php

namespace App\Http\Controllers\Frontend\MyOrder;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends FrontendController
{
    public function index(Request $request)  {
        $customer = Auth::guard('customer')->user();
        
        if (!$customer) {
            return redirect()->route('fe.auth.login')->with('error', 'Vui lòng đăng nhập để xem đơn hàng');
        }

        $status = $request->get('status', 'all');
        
        // Lấy đơn hàng của khách hàng
        $orders = Order::where('customer_id', $customer->id)
            ->with(['products', 'provinces'])
            ->orderBy('created_at', 'desc');

        $orders = $orders->paginate(10);
        
        $system = $this->system;
        $seo = [
            'meta_title' => 'Đơn hàng của tôi - ' . $customer->name,
            'meta_keyword' => 'đơn hàng, lịch sử mua hàng',
            'meta_description' => 'Xem lịch sử đơn hàng và theo dõi trạng thái giao hàng',
            'meta_image' => $system['homepage_logo'] ?? '',
            'canonical' => route('my-order.index')
        ];
        
        return view('frontend.order.my-order', compact('orders', 'customer', 'status', 'system', 'seo'));
    }

    public function detail(Request $request)  {
        $customer = Auth::guard('customer')->user();
        $orderCode = $request->get('code');

        if (!$customer) {
            return redirect()->route('fe.auth.login')->with('error', 'Vui lòng đăng nhập để xem chi tiết đơn hàng');
        }

        if (!$orderCode) {
            return redirect()->route('my-order.index')->with('error', 'Không tìm thấy mã đơn hàng');
        }

        $order = Order::where('code', $orderCode)
            ->where('customer_id', $customer->id)
            ->with(['products', 'provinces'])
            ->first();

        if (!$order) {
            return redirect()->route('my-order.index')->with('error', 'Không tìm thấy đơn hàng hoặc bạn không có quyền xem đơn hàng này');
        }

        $system = $this->system;
        $seo = [
            'meta_title' => 'Chi tiết đơn hàng #' . $order->code . ' - ' . $customer->name,
            'meta_keyword' => 'chi tiết đơn hàng, theo dõi đơn hàng',
            'meta_description' => 'Xem chi tiết đơn hàng #' . $order->code,
            'meta_image' => $system['homepage_logo'] ?? '',
            'canonical' => route('my-order.detail', ['code' => $order->code])
        ];

        return view('frontend.order.detail', compact('order', 'customer', 'system', 'seo'));
    }
}
