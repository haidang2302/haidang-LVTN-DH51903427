<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'supplier_id',
        'product_id',
        'quantity',
        'status',
        'note',
    ];
}
