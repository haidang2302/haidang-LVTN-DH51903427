<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('customer')->id() == null){
            if ($request->expectsJson()) {
                // Kiểm tra route để trả về message phù hợp
                $routeName = $request->route()->getName();
                $url = $request->url();
                $message = 'Bạn phải đăng nhập để sử dụng chức năng này';
                
                if (in_array($routeName, ['cart.checkout', 'cart.store']) || 
                    str_contains($url, 'checkout') || 
                    str_contains($url, 'thanh-toan')) {
                    $message = 'Bạn phải đăng nhập thì mới thanh toán được';
                } elseif (in_array($routeName, ['cart.cart', 'cart.index']) || 
                          str_contains($url, 'cart') || 
                          str_contains($url, 'gio-hang')) {
                    $message = 'Bạn phải đăng nhập thì mới vào giỏ hàng được';
                } elseif (in_array($routeName, ['ajax.cart.create', 'product.addToCart']) || 
                          str_contains($url, 'ajax/cart/create') || 
                          str_contains($url, 'add-to-cart') ||
                          $request->has('product_id')) {
                    $message = 'Bạn phải đăng nhập thì mới có thể mua hàng được';
                }
                
                return response()->json([
                    'message' => $message,
                    'code' => 401,
                    'redirect' => route('fe.auth.login')
                ], 401);
            }
            
            // Kiểm tra route để redirect đến trang thông báo phù hợp
            $routeName = $request->route()->getName();
            $url = $request->url();
            
            if (in_array($routeName, ['cart.checkout', 'cart.store']) || 
                str_contains($url, 'checkout') || 
                str_contains($url, 'thanh-toan')) {
                // Redirect đến trang yêu cầu đăng nhập cho thanh toán
                return redirect()->route('cart.require.login.checkout')
                               ->with('error', 'Bạn phải đăng nhập thì mới thanh toán được');
            } elseif (in_array($routeName, ['cart.cart', 'cart.index']) || 
                      str_contains($url, 'cart') || 
                      str_contains($url, 'gio-hang')) {
                // Redirect đến trang yêu cầu đăng nhập cho giỏ hàng
                return redirect()->route('cart.require.login')
                               ->with('error', 'Bạn phải đăng nhập thì mới vào giỏ hàng được');
            } elseif (in_array($routeName, ['ajax.cart.create', 'product.addToCart']) || 
                      str_contains($url, 'ajax/cart/create') || 
                      str_contains($url, 'add-to-cart') ||
                      $request->has('product_id')) {
                // Redirect đến trang login với thông báo mua hàng
                return redirect()->route('fe.auth.login')
                               ->with('error', 'Bạn phải đăng nhập thì mới có thể mua hàng được');
            }
            
            // Mặc định redirect đến login
            return redirect()->route('fe.auth.login')
                           ->with('error', 'Bạn phải đăng nhập để sử dụng chức năng này');
        }

        return $next($request);
    }
}
