@extends('frontend.homepage.layout')
@section('content')
<div class="profile-container pt20 pb20">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-medium">
            <div class="uk-width-large-1-4">
                @include('frontend.auth.customer.components.sidebar')
            </div>
            <div class="uk-width-large-3-4">
                <div class="panel-profile">
                    <div class="panel-head">
                        <div class="uk-flex uk-flex-middle uk-flex-space-between">
                            <div>
                                <h2 class="heading-2"><span>Chi tiết đơn hàng #{{ $order->code }}</span></h2>
                                <div class="description">
                                    Đặt hàng lúc {{ $order->created_at->format('H:i d/m/Y') }}
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('my-order.index') }}" class="uk-button uk-button-default">
                                    <i class="fa fa-arrow-left"></i> Quay lại
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <!-- Order Status -->
                        <div class="order-status-section mb30">
                            <div class="status-header">
                                <h3>Trạng thái đơn hàng</h3>
                            </div>
                            <div class="status-timeline">
                                @php
                                    $currentStatus = '';
                                    $statusClass = '';

                                    if($order->delivery == 'delivered') {
                                        $currentStatus = 'Đã giao hàng';
                                        $statusClass = 'status-delivered';
                                    } elseif($order->delivery == 'shipping') {
                                        $currentStatus = 'Đang giao hàng';
                                        $statusClass = 'status-shipping';
                                    } elseif($order->confirm == 'confirm') {
                                        $currentStatus = 'Đã xác nhận';
                                        $statusClass = 'status-confirmed';
                                    } elseif($order->confirm == 'cancelled') {
                                        $currentStatus = 'Đã hủy';
                                        $statusClass = 'status-cancelled';
                                    } else {
                                        $currentStatus = 'Chờ xác nhận';
                                        $statusClass = 'status-pending';
                                    }
                                @endphp
                                <div class="current-status {{ $statusClass }}">
                                    <span class="status-badge">{{ $currentStatus }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="customer-info-section mb30">
                            <h3>Thông tin khách hàng</h3>
                            <div class="info-grid uk-grid uk-grid-small">
                                <div class="uk-width-1-2">
                                    <div class="info-item">
                                        <label>Họ tên:</label>
                                        <span>{{ $order->fullname }}</span>
                                    </div>
                                    <div class="info-item">
                                        <label>Email:</label>
                                        <span>{{ $order->email }}</span>
                                    </div>
                                    <div class="info-item">
                                        <label>Số điện thoại:</label>
                                        <span>{{ $order->phone }}</span>
                                    </div>
                                </div>
                                <div class="uk-width-1-2">
                                    <div class="info-item">
                                        <label>Địa chỉ giao hàng:</label>
                                        <span>{{ $order->address }}</span>
                                    </div>
                                    @if($order->description)
                                    <div class="info-item">
                                        <label>Ghi chú:</label>
                                        <span>{{ $order->description }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Order Products -->
                        <div class="products-section mb30">
                            <h3>Sản phẩm đã đặt</h3>
                            <div class="products-list">
                                @foreach($order->products as $product)
                                <div class="product-row">
                                    <div class="uk-grid uk-grid-small uk-flex-middle">
                                        <div class="uk-width-1-6">
                                            <div class="product-image">
                                                <img src="{{ $product->pivot->option ? json_decode($product->pivot->option, true)['image'] ?? $product->image : $product->image }}" 
                                                     alt="{{ $product->pivot->name }}" />
                                            </div>
                                        </div>
                                        <div class="uk-width-3-6">
                                            <div class="product-details">
                                                <h4 class="product-name">{{ $product->pivot->name }}</h4>
                                                @if($product->pivot->option)
                                                    @php
                                                        $option = json_decode($product->pivot->option, true);
                                                    @endphp
                                                    @if(isset($option['variant']))
                                                        <p class="product-variant">Phân loại: {{ $option['variant'] }}</p>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="uk-width-1-6 uk-text-center">
                                            <div class="product-price">
                                                @if($product->pivot->priceOriginal > $product->pivot->price)
                                                    <div class="original-price">
                                                        {{ number_format($product->pivot->priceOriginal, 0, ',', '.') }}₫
                                                    </div>
                                                @endif
                                                <div class="current-price">
                                                    {{ number_format($product->pivot->price, 0, ',', '.') }}₫
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-1-6 uk-text-center">
                                            <div class="product-quantity">
                                                x{{ $product->pivot->qty }}
                                            </div>
                                        </div>
                                        <div class="uk-width-1-6 uk-text-right">
                                            <div class="product-total">
                                                {{ number_format($product->pivot->price * $product->pivot->qty, 0, ',', '.') }}₫
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="order-summary">
                            <h3>Tóm tắt đơn hàng</h3>
                            <div class="summary-table">
                                @if(isset($order->cart['cartTotal']))
                                <div class="summary-row">
                                    <span class="label">Tạm tính:</span>
                                    <span class="value">{{ number_format($order->cart['cartTotal'], 0, ',', '.') }}₫</span>
                                </div>
                                @endif
                                
                                @if(isset($order->cart['promotion']) && $order->cart['promotion']['discount'] > 0)
                                <div class="summary-row">
                                    <span class="label">Mã giảm giá:</span>
                                    <span class="value discount">-{{ number_format($order->cart['promotion']['discount'], 0, ',', '.') }}₫</span>
                                </div>
                                @endif
                                
                                <div class="summary-row">
                                    <span class="label">Phí vận chuyển:</span>
                                    <span class="value">Miễn phí</span>
                                </div>
                                
                                <div class="summary-row total-row">
                                    <span class="label">Tổng cộng:</span>
                                    <span class="value">{{ number_format($order->cart['cartTotal'] ?? 0, 0, ',', '.') }}₫</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        @if($order->payment)
                        <div class="payment-section mt30">
                            <h3>Thông tin thanh toán</h3>
                            <div class="payment-info">
                                <div class="info-item">
                                    <label>Phương thức thanh toán:</label>
                                    <span>{{ $order->payment }}</span>
                                </div>
                                @if($order->order_payments->count() > 0)
                                    @foreach($order->order_payments as $payment)
                                    <div class="info-item">
                                        <label>Trạng thái:</label>
                                        <span class="{{ $payment->status == 'completed' ? 'text-success' : 'text-warning' }}">
                                            {{ $payment->status == 'completed' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                        </span>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.order-status-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid #007bff;
}

.status-header h3 {
    margin: 0 0 15px 0;
    color: #333;
}

.current-status {
    text-align: center;
}

.status-badge {
    display: inline-block;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 14px;
}

.status-pending .status-badge { background: #fff3cd; color: #856404; }
.status-confirmed .status-badge { background: #d4edda; color: #155724; }
.status-shipping .status-badge { background: #cce7ff; color: #004085; }
.status-delivered .status-badge { background: #d4edda; color: #155724; }
.status-cancelled .status-badge { background: #f8d7da; color: #721c24; }

.customer-info-section, .products-section, .order-summary, .payment-section {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

.customer-info-section h3, .products-section h3, .order-summary h3, .payment-section h3 {
    margin: 0 0 20px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #007bff;
    color: #333;
}

.info-item {
    margin-bottom: 10px;
}

.info-item label {
    font-weight: bold;
    color: #555;
    display: inline-block;
    width: 120px;
}

.info-item span {
    color: #333;
}

.products-list {
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
}

.product-row {
    padding: 15px;
    border-bottom: 1px solid #eee;
}

.product-row:last-child {
    border-bottom: none;
}

.product-image img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
}

.product-name {
    margin: 0 0 5px 0;
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.product-variant {
    margin: 0;
    color: #666;
    font-size: 14px;
}

.original-price {
    text-decoration: line-through;
    color: #999;
    font-size: 12px;
}

.current-price {
    color: #e74c3c;
    font-weight: bold;
}

.product-quantity {
    font-weight: bold;
    color: #333;
}

.product-total {
    font-weight: bold;
    color: #007bff;
    font-size: 16px;
}

.summary-table {
    max-width: 400px;
    margin-left: auto;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

.summary-row:last-child {
    border-bottom: none;
}

.total-row {
    border-top: 2px solid #007bff;
    margin-top: 10px;
    padding-top: 15px;
    font-weight: bold;
    font-size: 18px;
}

.total-row .label {
    color: #333;
}

.total-row .value {
    color: #007bff;
}

.discount {
    color: #e74c3c !important;
}

.text-success {
    color: #28a745 !important;
}

.text-warning {
    color: #ffc107 !important;
}

@media (max-width: 768px) {
    .info-item label {
        width: 100%;
        display: block;
        margin-bottom: 5px;
    }
    
    .summary-table {
        max-width: 100%;
    }
    
    .product-image img {
        width: 60px;
        height: 60px;
    }
}
</style>
@endsection
@endsection