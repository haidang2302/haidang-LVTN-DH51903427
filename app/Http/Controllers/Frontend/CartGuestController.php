<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

class CartGuestController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Hiển thị trang thông báo cho khách chưa đăng nhập
     */
    public function requireLogin()
    {
        $seo = [
            'meta_title' => 'Đăng nhập để xem giỏ hàng',
            'meta_keyword' => 'đăng nhập, giỏ hàng, yêu cầu đăng nhập',
            'meta_description' => 'Bạn cần đăng nhập để có thể xem và quản lý giỏ hàng của mình',
            'meta_image' => '',
            'canonical' => write_url('yeu-cau-dang-nhap', TRUE, TRUE),
        ];
        
        $system = $this->system;
        $config = $this->config();
        
        return view('frontend.auth.require-login', compact(
            'config',
            'seo',
            'system'
        ));
    }

    /**
     * Hiển thị trang thông báo cho thanh toán
     */
    public function requireLoginCheckout()
    {
        $seo = [
            'meta_title' => 'Đăng nhập để thanh toán',
            'meta_keyword' => 'đăng nhập, thanh toán, yêu cầu đăng nhập',
            'meta_description' => 'Bạn cần đăng nhập để có thể tiến hành thanh toán đơn hàng',
            'meta_image' => '',
            'canonical' => write_url('yeu-cau-dang-nhap-thanh-toan', TRUE, TRUE),
        ];
        
        $system = $this->system;
        $config = $this->config();
        
        return view('frontend.auth.require-login-checkout', compact(
            'config',
            'seo',
            'system'
        ));
    }

    private function config()
    {
        return [
            'language' => $this->language,
            'css' => [
                'frontend/core/css/auth-required.css'
            ],
            'js' => [
                'frontend/core/library/auth-required.js'
            ]
        ];
    }
}