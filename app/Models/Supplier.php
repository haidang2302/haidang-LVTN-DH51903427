<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Supplier extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    // Tạo supplier mới
    public static function createSupplierSample()
    {
        $supplier = new Supplier();
        $supplier->name = 'Nhà cung cấp mẫu';
        $supplier->email = 'supplier@example.com';
        $supplier->phone = '0123456789';
        $supplier->address = 'Hà Nội';
        $supplier->password = Hash::make('12345678');
        return $supplier->save();
    }
}
