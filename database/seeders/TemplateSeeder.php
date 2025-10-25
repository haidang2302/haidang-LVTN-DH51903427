<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Template;
use App\Models\User;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        Template::create([
            'name' => 'Template Áo Nữ',
            'description' => 'Giao diện cho danh mục áo nữ',
            'user_id' => $user->id,
        ]);
        Template::create([
            'name' => 'Template Áo Nam',
            'description' => 'Giao diện cho danh mục áo nam',
            'user_id' => $user->id,
        ]);
    }
}
