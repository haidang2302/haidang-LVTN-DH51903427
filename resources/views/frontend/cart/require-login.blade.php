@extends('frontend.homepage.layout')

@section('content')
<div class="auth-required-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="auth-required-card">
                    <!-- Icon -->
                    <div class="auth-icon">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 7H18V6C18 3.79086 16.2091 2 14 2H10C7.79086 2 6 3.79086 6 6V7H5C4.44772 7 4 7.44772 4 8V20C4 20.5523 4.44772 21 5 21H19C19.5523 21 20 20.5523 20 20V8C20 7.44772 19.5523 7 19 7ZM8 6C8 4.89543 8.89543 4 10 4H14C15.1046 4 16 4.89543 16 6V7H8V6ZM12 12C11.4477 12 11 12.4477 11 13V17C11 17.5523 11.4477 18 12 18C12.5523 18 13 17.5523 13 17V13C13 12.4477 12.5523 12 12 12Z" fill="#e74c3c"/>
                        </svg>
                    </div>

                    <!-- Tiêu đề -->
                    <h1 class="auth-title">Yêu cầu đăng nhập</h1>
                    
                    <!-- Thông báo chính -->
                    <div class="auth-message">
                        <h3>Bạn phải đăng nhập thì mới vào giỏ hàng được!</h3>
                        <p>Để có thể xem và quản lý giỏ hàng của bạn, vui lòng đăng nhập vào tài khoản.</p>
                    </div>

                    <!-- Lợi ích khi đăng nhập -->
                    <div class="auth-benefits">
                        <h4>Khi đăng nhập, bạn có thể:</h4>
                        <ul>
                            <li>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#27ae60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Xem và quản lý giỏ hàng của bạn
                            </li>
                            <li>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#27ae60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Tiến hành thanh toán đơn hàng
                            </li>
                            <li>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#27ae60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Theo dõi lịch sử đơn hàng
                            </li>
                            <li>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#27ae60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Lưu danh sách sản phẩm yêu thích
                            </li>
                        </ul>
                    </div>

                    <!-- Nút hành động -->
                    <div class="auth-actions">
                        <a href="{{ route('fe.auth.login') }}" class="btn btn-login">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M15 3H19C19.5523 3 20 3.44772 20 4V20C20 20.5523 19.5523 21 19 21H15M10 17L15 12L10 7M15 12H3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Đăng nhập ngay
                        </a>
                        
                        <a href="{{ route('customer.register') }}" class="btn btn-register">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M12.5 7C12.5 9.20914 10.7091 11 8.5 11C6.29086 11 4.5 9.20914 4.5 7C4.5 4.79086 6.29086 3 8.5 3C10.7091 3 12.5 4.79086 12.5 7ZM20 8V14M23 11H17" stroke="#3498db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Đăng ký tài khoản
                        </a>
                        
                        <a href="{{ route('home.index') }}" class="btn btn-back">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M19 12H5M12 19L5 12L12 5" stroke="#6c757d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Quay lại trang chủ
                        </a>
                    </div>

                    <!-- Thông tin hỗ trợ -->
                    <div class="auth-support">
                        <p>Cần hỗ trợ? Liên hệ với chúng tôi qua:</p>
                        <div class="support-contacts">
                            <a href="tel:{{ $system['contact_hotline'] ?? '' }}" class="support-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M22 16.92V19.92C22 20.9 21.11 21.78 20.12 21.78C9.07 21.78 0.22 12.93 0.22 1.88C0.22 0.89 1.1 0.01 2.09 0.01H5.09C5.56 0.01 5.96 0.36 6.01 0.83L6.53 4.83C6.58 5.3 6.35 5.74 5.97 5.95L4.15 6.86C5.53 9.69 7.84 12 10.67 13.38L11.58 11.56C11.78 11.18 12.23 10.95 12.7 11L16.7 11.52C17.17 11.57 17.52 11.97 17.52 12.44V15.44C17.52 16.43 16.64 17.31 15.65 17.31H12.65" stroke="#6c757d" stroke-width="1.5"/>
                                </svg>
                                {{ $system['contact_hotline'] ?? 'Hotline' }}
                            </a>
                            <a href="mailto:{{ $system['contact_email'] ?? '' }}" class="support-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="#6c757d" stroke-width="1.5"/>
                                    <path d="M22 6L12 13L2 6" stroke="#6c757d" stroke-width="1.5"/>
                                </svg>
                                {{ $system['contact_email'] ?? 'Email' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.auth-required-container {
    min-height: 80vh;
    display: flex;
    align-items: center;
    padding: 60px 0;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.auth-required-card {
    background: white;
    border-radius: 20px;
    padding: 50px 40px;
    text-align: center;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
}

.auth-icon {
    margin-bottom: 30px;
}

.auth-title {
    color: #2c3e50;
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 20px;
}

.auth-message h3 {
    color: #e74c3c;
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 15px;
}

.auth-message p {
    color: #6c757d;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 40px;
}

.auth-benefits {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 40px;
    text-align: left;
}

.auth-benefits h4 {
    color: #2c3e50;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
}

.auth-benefits ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.auth-benefits li {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 0;
    color: #495057;
    font-size: 15px;
}

.auth-actions {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 40px;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 15px 30px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn-login {
    background: #e74c3c;
    color: white;
}

.btn-login:hover {
    background: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(231, 76, 60, 0.3);
}

.btn-register {
    background: white;
    color: #3498db;
    border-color: #3498db;
}

.btn-register:hover {
    background: #3498db;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
}

.btn-back {
    background: white;
    color: #6c757d;
    border-color: #dee2e6;
}

.btn-back:hover {
    background: #6c757d;
    color: white;
    transform: translateY(-2px);
}

.auth-support {
    border-top: 1px solid #e9ecef;
    padding-top: 30px;
    color: #6c757d;
    font-size: 14px;
}

.support-contacts {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 15px;
}

.support-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6c757d;
    text-decoration: none;
    transition: color 0.3s ease;
}

.support-item:hover {
    color: #495057;
}

@media (max-width: 768px) {
    .auth-required-card {
        padding: 30px 20px;
        margin: 20px;
    }
    
    .auth-title {
        font-size: 24px;
    }
    
    .auth-message h3 {
        font-size: 20px;
    }
    
    .support-contacts {
        flex-direction: column;
        gap: 15px;
    }
}
</style>
@endsection