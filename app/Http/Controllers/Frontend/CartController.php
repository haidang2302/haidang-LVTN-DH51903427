<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface  as ProvinceRepository;
// ...existing use statements...
 use App\Repositories\Interfaces\OrderRepositoryInterface  as OrderRepository;
use App\Http\Requests\StoreCartRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Classes\Vnpay;
use App\Classes\Momo;
use App\Classes\Paypal;
use App\Classes\Zalo;

class CartController extends FrontendController
{
  
    protected $provinceRepository;
    // ...existing properties...
    protected $orderRepository;
    protected $cartService;
    protected $vnpay;
    protected $momo;
    protected $paypal;
    protected $zalo;

    public function __construct(
        ProvinceRepository $provinceRepository,
    // ...existing constructor params...
        OrderRepository $orderRepository,
        CartService $cartService,
        Vnpay $vnpay,
        Momo $momo,
        Paypal $paypal,
        Zalo $zalo,
    ){
        $this->middleware('auth:customer');
        $this->provinceRepository = $provinceRepository;
    // ...existing constructor body...
        $this->orderRepository = $orderRepository;
        $this->cartService = $cartService;
        $this->vnpay = $vnpay;
        $this->momo = $momo;
        $this->paypal = $paypal;
        $this->zalo = $zalo;
        parent::__construct();
    }

    public function cart(){
        $provinces = $this->provinceRepository->all();
        $carts = Cart::instance('shopping')->content();
        $carts = $this->cartService->remakeCart($carts);
        $cartCaculate = $this->cartService->reCaculateCart();
        $cartPromotion = $this->cartService->cartPromotion($cartCaculate['cartTotal']);

        $seo = [
            'meta_title' => 'Giỏ hàng của bạn',
            'meta_keyword' => '',
            'meta_description' => '',
            'meta_image' => '',
            'canonical' => write_url('gio-hang', TRUE, TRUE),
        ];
        $system = $this->system;
        $config = $this->config();
        return view('frontend.cart.index', compact(
            'config',
            'seo',
            'system',
            'carts',
            'cartPromotion',
            'cartCaculate',
            'provinces',
        ));
    }


    public function checkout(){
        $provinces = $this->provinceRepository->all();
        $carts = Cart::instance('shopping')->content();
        $carts = $this->cartService->remakeCart($carts);
        $cartCaculate = $this->cartService->reCaculateCart();
        $cartPromotion = $this->cartService->cartPromotion($cartCaculate['cartTotal']);

        $seo = [
            'meta_title' => 'Trang thanh toán đơn hàng',
            'meta_keyword' => '',
            'meta_description' => '',
            'meta_image' => '',
            'canonical' => write_url('thanh-toan', TRUE, TRUE),
        ];
        $system = $this->system;
        $config = $this->config();
        return view('frontend.cart.index', compact(
            'config',
            'seo',
            'system',
            'provinces',
            'carts',
            'cartPromotion',
            'cartCaculate',
        ));
        
    }

    public function store(StoreCartRequest $request){
        $system = $this->system;
        $order = $this->cartService->order($request, $system);
        if($order['flag']){
            if($order['order']->method !== 'cod'){
                $response = $this->paymentMethod($order);
                if($response['errorCode'] == 0){
                    return redirect()->away($response['url']);
                }
            }
            return redirect()->route('cart.success', ['code' => $order['order']->code])->with('success','Đặt hàng thành công');
        }
        return redirect()->route('cart.checkout')->with('error','Đặt hàng không thành công. Hãy thử lại');
    }

    public function success($code){
        $order = $this->orderRepository->findByCondition([
            ['code', '=', $code],
        ], false, ['products']);
        // Nếu đơn hàng đang ở trạng thái 'pending', chuyển sang 'confirm'
       // if ($order && $order->confirm == 'pending') {
         //   $order->confirm = 'confirm';
        //    $order->save();
       // }
        $seo = [
            'meta_title' => 'Thanh toán đơn hàng thành công',
            'meta_keyword' => '',
            'meta_description' => '',
            'meta_image' => '',
            'canonical' => write_url('cart/success', TRUE, TRUE),
        ];
        $system = $this->system;
        $config = $this->config();
        return view('frontend.cart.success', compact(
            'config',
            'seo',
            'system',
            'order'
        ));
    }

    public function paymentMethod($order = null){
        $class = $order['order']->method;
        $response = $this->{$class}->payment($order['order']);
        return $response;
    }

    /**
     * Tiếp tục thanh toán đơn hàng chờ xử lý
     */
   /* public function continueOrder($orderCode)
    {
        $customer = auth()->guard('customer')->user();
        if (!$customer) {
            return redirect()->route('fe.auth.login')->with('error', 'Vui lòng đăng nhập để tiếp tục thanh toán');
        }
        $order = $this->orderRepository->findByCondition([
            ['code', '=', $orderCode],
            ['customer_id', '=', $customer->id],
            ['confirm', '=', 'pending'],
        ], false, ['products']);
        if (!$order) {
            return redirect()->route('my-order.index')->with('error', 'Không tìm thấy đơn hàng hoặc đơn hàng không ở trạng thái chờ xử lý');
        }
        // Xóa giỏ hàng hiện tại
        Cart::instance('shopping')->destroy();
        // Nạp lại sản phẩm từ đơn hàng vào giỏ hàng
        foreach ($order->products as $product) {
            $options = $product->pivot->option ? json_decode($product->pivot->option, true) : [];
            Cart::instance('shopping')->add([
                'id' => $product->pivot->product_id . ($product->pivot->uuid ? '_' . $product->pivot->uuid : ''),
                'name' => $product->pivot->name,
                'qty' => $product->pivot->qty,
                'price' => $product->pivot->price,
                'weight' => 0,
                'options' => $options,
            ]);
        }
        // Chuyển hướng về trang checkout
        return redirect()->route('cart.checkout');
    }*/
    
    private function config(){
        return [
            'language' => $this->language,
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js' => [
                'backend/library/location.js',
                'frontend/core/library/cart.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
            ]
        ];
    }
  

}
