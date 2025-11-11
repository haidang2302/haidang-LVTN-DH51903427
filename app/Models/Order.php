<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class Order extends Model
{
    use HasFactory, QueryScopes;

    protected $fillable = [
        'code',
        'user_id',
        'fullname',
        'email',
        'phone',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'description',
        'cart',
        'shipping',
        'method',
        'confirm',
        'payment',
        'promotion',
        'customer_id',
    ];

    protected $table = 'orders';

    public function products(){
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
                    ->withPivot('uuid', 'name', 'qty', 'price', 'priceOriginal', 'option')
                    ->withTimestamps();
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
