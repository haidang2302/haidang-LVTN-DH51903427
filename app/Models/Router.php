<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 class Router extends Model
 {
     use HasFactory;
     protected $table = "routers";
     protected $fillable = [
         'canonical',//chuỗi định danh của sản phẩm
         'module',//mô-đun
         'controller',//đường dẫn
     ];
 }