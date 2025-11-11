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
                            <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="#f39c12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 22V12H15V22" stroke="#f39c12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="12" cy="8" r="3" fill="#f39c12"/>
                        </svg>
                    </div>

                    <!-- Tiêu đề -->
                    <h1 class="auth-title">Đăng nhập để thanh toán</h1>
                    
                    <!-- Thông báo chính -->
                    <div class="auth-message">
                        <h3>Bạn phải đăng nhập thì mới thanh toán được!</h3>
                        <p>Để bảo mật thông tin và tiến hành thanh toán an toàn, vui lòng đăng nhập vào tài khoản của bạn.</p>
                    </div>

                    <!-- Quy trình thanh toán -->
                    <div class="checkout-process">
                        <h4>Quy trình thanh toán của chúng tôi:</h4>
                        <div class="process-steps">
                            <div class="step">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h5>Đăng nhập</h5>
                                    <p>Xác thực tài khoản để bảo mật</p>
                                </div>
                            </div>
                            <div class="step">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h5>Chọn sản phẩm</h5>
                                    <p>Thêm sản phẩm vào giỏ hàng</p>
                                </div>
                            </div>
                            <div class="step">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h5>Thanh toán</h5>
                                    <p>Hoàn tất đơn hàng an toàn</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lợi ích bảo mật -->
                    <div class="security-benefits">
                        <h4>Tại sao cần đăng nhập?</h4>
                        <div class="benefits-grid">
                            <div class="benefit-item">
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1Z" stroke="#27ae60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 12L11 14L15 10" stroke="#27ae60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <h5>Bảo mật thông tin</h5>
                                <p>Thông tin cá nhân và thanh toán được mã hóa an toàn</p>
                            </div>
                            <div class="benefit-item">
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#3498db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 2V8H20" stroke="#3498db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <h5>Lưu trữ đơn hàng</h5>
                                <p>Theo dõi lịch sử mua hàng và trạng thái đơn hàng</p>
                            </div>
                            <div class="benefit-item">
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 11H15M9 15H15M17 21L12 16L7 21V5C7 4.46957 7.21071 3.96086 7.58579 3.58579C7.96086 3.21071 8.46957 3 9 3H15C15.5304 3 16.0391 3.21071 16.4142 3.58579C16.7893 3.96086 17 4.46957 17 5V21Z" stroke="#e74c3c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <h5>Hỗ trợ nhanh chóng</h5>
                                <p>Nhận hỗ trợ kỹ thuật và chăm sóc khách hàng tốt hơn</p>
                            </div>
                        </div>
                    </div>

                    <!-- Nút hành động -->
                    <div class="auth-actions">
                        <a href="{{ route('fe.auth.login') }}" class="btn btn-login">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M15 3H19C19.5523 3 20 3.44772 20 4V20C20 20.5523 19.5523 21 19 21H15M10 17L15 12L10 7M15 12H3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Đăng nhập để thanh toán
                        </a>
                        
                        <div class="action-row">
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
                                Tiếp tục mua sắm
                            </a>
                        </div>
                    </div>

                    <!-- Thông tin hỗ trợ -->
                    <div class="auth-support">
                        <p>Gặp khó khăn khi đăng nhập? Liên hệ hỗ trợ:</p>
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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.auth-required-card {
    background: white;
    border-radius: 20px;
    padding: 50px 40px;
    text-align: center;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    border: 1px solid #e9ecef;
}

.checkout-process {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 40px;
}

.checkout-process h4 {
    color: #2c3e50;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 25px;
}

.process-steps {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.step {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.step-number {
    width: 50px;
    height: 50px;
    background: #3498db;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 20px;
    margin-bottom: 15px;
}

.step-content h5 {
    color: #2c3e50;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
}

.step-content p {
    color: #6c757d;
    font-size: 14px;
    margin: 0;
}

.security-benefits {
    background: #fff9f0;
    border: 1px solid #fed7aa;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 40px;
}

.security-benefits h4 {
    color: #ea580c;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 25px;
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px;
}

.benefit-item {
    text-align: center;
}

.benefit-item h5 {
    color: #2c3e50;
    font-size: 16px;
    font-weight: 600;
    margin: 15px 0 10px;
}

.benefit-item p {
    color: #6c757d;
    font-size: 14px;
    line-height: 1.5;
    margin: 0;
}

.action-row {
    display: flex;
    gap: 15px;
}

.action-row .btn {
    flex: 1;
}

@media (max-width: 768px) {
    .process-steps {
        flex-direction: column;
        gap: 30px;
    }
    
    .step {
        flex-direction: row;
        text-align: left;
    }
    
    .step-number {
        margin-right: 20px;
        margin-bottom: 0;
        flex-shrink: 0;
    }
    
    .benefits-grid {
        grid-template-columns: 1fr;
    }
    
    .action-row {
        flex-direction: column;
    }
}
</style>
@endsection