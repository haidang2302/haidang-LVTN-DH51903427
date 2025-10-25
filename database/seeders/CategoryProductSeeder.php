<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $aoNu = Category::create([
            'name' => 'Áo Nữ',
            'description' => 'Các loại áo dành cho nữ',
        ]);
        $aoNam = Category::create([
            'name' => 'Áo Nam',
            'description' => 'Các loại áo dành cho nam',
        ]);

        Product::create([
            'name' => 'Áo Len Nữ Mỏng Cổ Cao 5cm',
            'short_description' => 'Chất vải mềm mại, an toàn cho da, độ co giãn đàn hồi',
            'price' => 400000,
            'image' => 'products/ao-len-nu.jpg',
            'category_id' => $aoNu->id,
        ]);
        Product::create([
            'name' => 'Áo Sơ Mi Tay Dài Nữ Phối Tay Voan',
            'short_description' => 'Thanh lịch - Sang trọng - Mềm mại',
            'price' => 400000,
            'image' => 'products/ao-so-mi-nu.jpg',
            'category_id' => $aoNu->id,
        ]);
        Product::create([
            'name' => 'Áo Thun Nam Basic',
            'short_description' => 'Chất vải cotton thoáng mát',
            'price' => 250000,
            'image' => 'products/ao-thun-nam.jpg',
            'category_id' => $aoNam->id,
        ]);
        Product::create([
            'name' => 'Áo Polo Nam Trắng',
            'short_description' => 'Lịch sự, trẻ trung',
            'price' => 300000,
            'image' => 'products/ao-polo-nam.jpg',
            'category_id' => $aoNam->id,
        ]);
        Product::create([
            'name' => 'Áo Thun Nam Đen',
            'short_description' => 'Đơn giản, dễ phối đồ',
            'price' => 250000,
            'image' => 'products/ao-thun-nam-den.jpg',
            'category_id' => $aoNam->id,
        ]);
    }
}
