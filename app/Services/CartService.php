<?php

namespace App\Services;

use App\Services\Interfaces\CartServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;
use App\Repositories\Interfaces\ProductVariantRepositoryInterface  as ProductVariantRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Mail\OrderMail;

/**
 * Class AttributeCatalogueService
 * @package App\Services
 */
class CartService  implements CartServiceInterface
{

    protected $productRepository;
    protected $productVariantRepository;
    protected $promotionRepository;
    protected $orderRepository;
    protected $productService;

    public function __construct(
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
        PromotionRepository $promotionRepository,
        OrderRepository $orderRepository,
        ProductService $productService,
    ){
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->promotionRepository = $promotionRepository;
        $this->orderRepository = $orderRepository;
        $this->productService = $productService;
    }

    

    public function create($request, $language = 1){
        try{
            $payload = $request->input();
            \Log::info('CartService create payload:', $payload);
            // Kiểm tra tồn tại và giá trị của các key
            $id = isset($payload['id']) ? $payload['id'] : null;
            $quantity = isset($payload['quantity']) ? $payload['quantity'] : 1;
            $attribute_id = isset($payload['attribute_id']) && is_array($payload['attribute_id']) ? $payload['attribute_id'] : [];
            if ($id === null) {
                throw new \Exception('Product ID is required');
            }
            $product = $this->productRepository->findById($id, ['*'], [
                'languages' => function($query) use ($language) {
                    $query->where('language_id',  $language);
                }
            ]);
            $productName = '';
            if ($product && $product->languages && $product->languages->first() && isset($product->languages->first()->pivot->name)) {
                $productName = $product->languages->first()->pivot->name;
            }
            $data = [
                'id' => $product->id,
                'name' => $productName,
                'qty' => $quantity,
            ];
            if(count($attribute_id)){
                $attributeId = sortAttributeId($attribute_id);
                $variant = $this->productVariantRepository->findVariant($attributeId, $product->id, $language);
                $variantPromotion = isset($variant->uuid) ? $this->promotionRepository->findPromotionByVariantUuid($variant->uuid) : null;
                $variantPrice = is_object($variant) ? getVariantPrice($variant, $variantPromotion) : ['priceSale' => 0, 'price' => 0];

                $variantName = '';
                if (is_object($variant) && $variant->languages()->first() && isset($variant->languages()->first()->pivot->name)) {
                    $variantName = $variant->languages()->first()->pivot->name;
                }
                $data['id'] =  $product->id.(isset($variant->uuid) ? '_'.$variant->uuid : '');
                $data['name'] = $productName.' '.$variantName;
                $data['price'] = (isset($variantPrice['priceSale']) && $variantPrice['priceSale'] > 0) ? $variantPrice['priceSale'] : ($variantPrice['price'] ?? 0);
                $data['options'] = [
                    'attribute' => $attribute_id,
                ];
            }else{
                $product = $this->productService->combineProductAndPromotion([$product->id], $product, true); 
                $price = getPrice($product);
                $data['price'] = (isset($price['priceSale']) && $price['priceSale'] > 0) ? $price['priceSale'] : ($price['price'] ?? 0);
            }

            Cart::instance('shopping')->add($data);

            return true;
        }catch(\Exception $e ){
            echo $e->getMessage().$e->getCode();die();
        }
    }

    public function update($request){
        try{
            $payload = $request->input();
            Cart::instance('shopping')->update($payload['rowId'], $payload['qty']);
            $cartCaculate = $this->cartAndPromotion();
            $cartItem = Cart::instance('shopping')->get($payload['rowId']);
            $cartCaculate['cartItemSubTotal'] = $cartItem->qty * $cartItem->price;

            return $cartCaculate;
        }catch(\Exception $e ){
            echo $e->getMessage().$e->getCode();die();
        }
    }

    public function delete($request){
        try{
            $payload = $request->input();
            Cart::instance('shopping')->remove($payload['rowId']);
            $cartCaculate = $this->cartAndPromotion();
            return $cartCaculate;
        }catch(\Exception $e ){
            echo $e->getMessage().$e->getCode();die();
        }
    }


    public function order($request, $system){
        DB::beginTransaction();
        try{
            $payload = $this->request($request);
            // Kiểm tra dữ liệu đầu vào trước khi tạo order
            $requiredFields = ['fullname', 'email', 'phone', 'address'];
            foreach ($requiredFields as $field) {
                if (!isset($payload[$field]) || empty($payload[$field])) {
                    throw new \Exception('Thiếu thông tin: ' . $field);
                }
            }
            $order = $this->orderRepository->create($payload);
            if($order->id > 0){
                $this->createOrderProduct($payload, $order, $request);
                $this->mail($order, $system);
                Cart::instance('shopping')->destroy();
            }
            DB::commit();
            return [
                'order' => $order,
                'flag' => TRUE,
            ];
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
        }
    }

    private function mail($order, $sytem){
        $to = $order->email;
        $cc = $sytem['contact_email'];
        $carts = Cart::instance('shopping')->content();
        $carts = $this->remakeCart($carts);
        $cartCaculate = $this->cartAndPromotion();
        $cartPromotion = $this->cartPromotion($cartCaculate['cartTotal']);
        $data = [
            'order' => $order, 
            'carts' => $carts, 
            'cartCaculate' => $cartCaculate, 
            'cartPromotion' => $cartPromotion
        ];
        
        \Mail::to($to)->cc($cc)->send(new OrderMail($data));

    }


    

    private function createOrderProduct($payload, $order, $request){
        $carts = Cart::instance('shopping')->content();
        $carts = $this->remakeCart($carts);
        $temp = [];
        if(!is_null($carts)){
            foreach($carts as $key => $val){
                $extract = explode('_', $val->id);
                $temp[] = [
                    'product_id' => $extract[0],
                    'uuid' => ($extract[1]) ?? null,
                    'name' => $val->name,
                    'qty' => $val->qty,
                    'price' => $val->price,
                    'priceOriginal' => $val->priceOriginal,
                    'option' => json_encode($val->options), 
                ];
            }     
        }
        $order->products()->sync($temp);
    }

    private function request($request){
        
        $cartCaculate = $this->reCaculateCart();
        $cartPromotion = $this->cartPromotion($cartCaculate['cartTotal']);

        $payload = $request->except(['_token', 'voucher', 'create']);
        $payload['code'] = time();
        $payload['cart'] = $cartCaculate;
        $selectedPromotion = (isset($cartPromotion['selectedPromotion']) && is_object($cartPromotion['selectedPromotion'])) ? $cartPromotion['selectedPromotion'] : null;
        $payload['promotion'] = [
            'discount' => $cartPromotion['discount'] ?? '',
            'name' => $selectedPromotion ? $selectedPromotion->name : '',
            'code' => $selectedPromotion ? $selectedPromotion->code : '',
            'startDate' => $selectedPromotion ? $selectedPromotion->startDate : '',
            'endDate' => $selectedPromotion ? $selectedPromotion->endDate : '',
        ];
        $payload['confirm'] = 'confirm'; // Tự động xác nhận đơn hàng khi đặt
        $payload['delivery'] = 'pending';
        $payload['payment'] = 'unpaid';

        // Xử lý customer_id nếu người dùng đã đăng nhập
        $customer = \Auth::guard('customer')->user();
        if($customer && isset($customer->id)) {
            $payload['customer_id'] = $customer->id;
            $payload['guest_cookie'] = null;

            // Debug log để kiểm tra
            \Log::info('Order created with customer_id', [
                'customer_id' => $customer->id,
                'customer_email' => isset($customer->email) ? $customer->email : '',
                'order_code' => $payload['code']
            ]);
        } else {
            $payload['customer_id'] = null;
            $payload['guest_cookie'] = $request->session()->getId();

            // Debug log
            \Log::info('Order created as guest', [
                'guest_cookie' => $request->session()->getId(),
                'order_code' => $payload['code']
            ]);
        }

        // Đảm bảo các trường bắt buộc không bị null
        $requiredFields = ['fullname', 'email', 'phone', 'address'];
        foreach ($requiredFields as $field) {
            if (!isset($payload[$field])) {
                $payload[$field] = '';
            }
        }

        return $payload;
    }

    private function cartAndPromotion(){
        $cartCaculate = $this->reCaculateCart();
        $cartPromotion = $this->cartPromotion($cartCaculate['cartTotal']);
        $cartCaculate['cartTotal'] = $cartCaculate['cartTotal'] - $cartPromotion['discount'];
        $cartCaculate['cartDiscount'] = $cartPromotion['discount'];

        return $cartCaculate;
    }

    public function reCaculateCart(){
        $carts = Cart::instance('shopping')->content();
        $total = 0;
        $totalItems = 0;
        foreach($carts as $cart){
            $total = $total + $cart->price * $cart->qty;
            $totalItems = $totalItems + $cart->qty;
        }
        return [
            'cartTotal' => $total,
            'cartTotalItems' => $totalItems
        ];
    }



    public function remakeCart($carts){
        $cartId = $carts->pluck('id')->all();
        $temp = [];
        $objects = [];
        if(count($cartId)){
            foreach($cartId as $key => $val){
                $extract = explode('_', $val);
                if(count($extract) > 1){
                    $temp['variant'][] = $extract[1];
                }else{
                    $temp['product'][] = $extract[0];
                }
            }

            
            if(isset($temp['variant'])){
                $objects['variants'] = $this->productVariantRepository->findByCondition(
                    [], true, [], ['id', 'desc'], ['whereIn' => $temp['variant'], 'whereInField' => 'uuid']
                )->keyBy('uuid');
            }
            
            if(isset($temp['product'])){
                $objects['products'] = $this->productRepository->findByCondition(
                    [
                        config('apps.general.defaultPublish')
                    ], true, [], ['id', 'desc'], ['whereIn' => $temp['product'], 'whereInField' => 'id']
                )->keyBy('id');
            }
           

            foreach($carts as $keyCart => $cart){
                $explode = explode('_', $cart->id);
                $objectId = $explode[1] ?? $explode[0];
                if (isset($objects['variants'][$objectId])) {
                    $variantItem = $objects['variants'][$objectId];
                    $variantImage = explode(',' ,$variantItem->album)[0] ?? null;
                    $cart->setImage($variantImage)->setPriceOriginal($variantItem->price);
                } elseif (isset($objects['products'][$objectId])) {
                    $productItem = $objects['products'][$objectId];
                    $cart->setImage($productItem->image)->setPriceOriginal($productItem->price);

                }
            }

        }

        return $carts;
    }

    public function cartPromotion($cartTotal = 0){
        $maxDiscount = 0;
        $selectedPromotion = null;
        $promotions = $this->promotionRepository->getPromotionByCartTotal();
        if(!is_null($promotions)){
            foreach($promotions as $promotion){
                $discount = $promotion->discountInformation['info'];
                $amountFrom = $discount['amountFrom'] ?? [];
                $amountTo = $discount['amountTo'] ?? [];
                $amountValue = $discount['amountValue'] ?? [];
                $amountType = $discount['amountType'] ?? [];


                if(!empty($amountFrom) && count($amountFrom) == count($amountTo) && count($amountTo) == count($amountValue)){
                    for($i = 0; $i < count($amountFrom); $i++){
                        $currentAmountFrom = convert_price($amountFrom[$i]);
                        $currentAmountTo = convert_price($amountTo[$i]);
                        $currentAmountValue = convert_price($amountValue[$i]);
                        $currentAmountType = $amountType[$i];
                        if($cartTotal > $currentAmountFrom && ($cartTotal <= $currentAmountTo ) || $cartTotal > $currentAmountTo){

                            if($currentAmountType == 'cash'){
                                $maxDiscount = max($maxDiscount, $currentAmountValue);
                            }else if($currentAmountType == 'percent'){
                                $discountValue = ($currentAmountValue/100)*$cartTotal;
                                $maxDiscount = max($maxDiscount, $discountValue);
                            }
                            $selectedPromotion = $promotion;
                        }

                    }
                }
            }
        }
        return [
            'discount' => $maxDiscount,
            'selectedPromotion' => $selectedPromotion
        ];
    }
   
}
