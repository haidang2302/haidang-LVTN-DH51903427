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
                        <h2 class="heading-2"><span>Đơn hàng của tôi</span></h2>
                        <div class="description">
                            Quản lý thông tin và theo dõi đơn hàng
                        </div>
                    </div>
                    <div class="panel-body">
                        @if($orders->count() > 0)
                            @foreach($orders as $order)
                            <div class="order-item mb20">
                                <div class="order-header">
                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                        <div>
                                            <strong>Đơn hàng #{{ $order->code }}</strong>
                                            <span class="order-date">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                        <div>
                                            @php
                                                $statusText = '';
                                                $statusClass = '';
                                                switch($order->confirm) {
                                                    
                                                    case 'confirm':
                                                        $statusText = 'Đã xác nhận';
                                                        $statusClass = 'status-confirmed';
                                                        break;
                                                    case 'cancelled':
                                                        $statusText = 'Đã hủy';
                                                        $statusClass = 'status-cancelled';
                                                        break;
                                                    default:
                                                        $statusText = 'Chờ xử lý';
                                                        $statusClass = 'status-pending';
                                                }
                                                
                                                if($order->delivery == 'shipping') {
                                                    $statusText = 'Đang giao hàng';
                                                    $statusClass = 'status-shipping';
                                                } elseif($order->delivery == 'delivered') {
                                                    $statusText = 'Đã giao hàng';
                                                    $statusClass = 'status-delivered';
                                                }
                                            @endphp
                                            <span class="order-status {{ $statusClass }}">{{ $statusText }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="order-products">
                                    @foreach($order->products as $product)
                                    <div class="product-item uk-flex uk-flex-middle">
                                        <div class="product-image">
                                            <img src="{{ $product->pivot->option ? json_decode($product->pivot->option, true)['image'] ?? $product->image : $product->image }}" 
                                                 alt="{{ $product->pivot->name }}" 
                                                 style="width: 80px; height: 80px; object-fit: cover;">
                                        </div>
                                        <div class="product-info uk-flex-1">
                                            <h4 class="product-name">{{ $product->pivot->name }}</h4>
                                            @if($product->pivot->option)
                                                @php
                                                    $option = json_decode($product->pivot->option, true);
                                                @endphp
                                                @if(isset($option['variant']))
                                                    <p class="product-variant">Phân loại: {{ $option['variant'] }}</p>
                                                @endif
                                            @endif
                                            <p class="product-quantity">Số lượng: x{{ $product->pivot->qty }}</p>
                                        </div>
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
                                    @endforeach
                                </div>
                                
                                <div class="order-footer">
                                    <div class="order-total">
                                        <strong>Tổng tiền: {{ number_format($order->cart['cartTotal'] ?? 0, 0, ',', '.') }}₫</strong>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <!-- Pagination -->
                            <div class="pagination-wrapper">
                                {{ $orders->appends(request()->query())->links() }}
                            </div>
                        @else
                            <div class="empty-orders">
                                <div class="empty-icon">
                                    <i class="fa fa-shopping-cart fa-3x"></i>
                                </div>
                                <h3>Chưa có đơn hàng nào</h3>
                                <p>Hãy tiếp tục mua sắm để tạo đơn hàng đầu tiên của bạn!</p>
                                <a href="{{ route('home.index') }}" class="uk-button uk-button-primary">Tiếp tục mua sắm</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.order-tabs .uk-tab {
    border-bottom: 1px solid #ddd;
    margin-bottom: 20px;
}

.order-tabs .uk-tab > li > a {
    padding: 10px 20px;
    color: #666;
    text-decoration: none;
    border-bottom: 2px solid transparent;
}

.order-tabs .uk-tab > li.uk-active > a,
.order-tabs .uk-tab > li:hover > a {
    color: #007bff;
    border-bottom-color: #007bff;
}

.order-item {
    border: none;
    border-radius: 12px;
    background: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all 0.3s ease;
    margin-bottom: 20px;
}

.order-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.order-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 18px 25px;
    border-bottom: 2px solid #f1f3f4;
}

.order-header strong {
    font-size: 17px;
    color: #2c3e50;
    font-weight: 700;
}

.order-date {
    color: #6c757d;
    margin-left: 12px;
    font-size: 14px;
    font-weight: 500;
}

.order-status {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.status-pending { 
    background: linear-gradient(45deg, #ffeaa7, #fdcb6e);
    color: #e17055;
}
.status-confirmed { 
    background: linear-gradient(45deg, #a8e6cf, #81c784);
    color: #27ae60;
}
.status-shipping { 
    background: linear-gradient(45deg, #74b9ff, #0984e3);
    color: #fff;
}
.status-delivered { 
    background: linear-gradient(45deg, #55efc4, #00b894);
    color: #00695c;
}
.status-cancelled { 
    background: linear-gradient(45deg, #ff7675, #e84393);
    color: #fff;
}

.order-products {
    padding: 22px 25px;
    background: #fafbfc;
}

.product-item {
    margin-bottom: 18px;
    padding: 18px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
    border-left: 4px solid #e3f2fd;
}

.product-item:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    border-left-color: #2196f3;
}

.product-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.product-image {
    margin-right: 18px;
}

.product-image img {
    border-radius: 8px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.product-image:hover img {
    transform: scale(1.05);
}

.product-name {
    margin: 0 0 8px 0;
    font-size: 16px;
    font-weight: 600;
    color: #2c3e50;
    line-height: 1.4;
}

.product-variant, .product-quantity {
    margin: 4px 0;
    color: #7f8c8d;
    font-size: 14px;
    font-weight: 500;
}

.product-price {
    text-align: right;
}

.original-price {
    text-decoration: line-through;
    color: #bdc3c7;
    font-size: 13px;
    margin-bottom: 4px;
}

.current-price {
    color: #e74c3c;
    font-weight: 700;
    font-size: 17px;
    text-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

.order-footer {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 18px 25px;
    border-top: 2px solid #f1f3f4;
}

.order-total {
    font-size: 18px;
    font-weight: 700;
    color: #2980b9;
}

.order-total strong {
    background: linear-gradient(45deg, #3498db, #2980b9);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.empty-orders {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.empty-icon {
    margin-bottom: 20px;
    color: #ccc;
}

.empty-orders h3 {
    margin: 0 0 10px 0;
    font-size: 24px;
}

.empty-orders p {
    margin-bottom: 30px;
    font-size: 16px;
}

.pagination-wrapper {
    text-align: center;
    margin-top: 30px;
}
</style>
@endsection