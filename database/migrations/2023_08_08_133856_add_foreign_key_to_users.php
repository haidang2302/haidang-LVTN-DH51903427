<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Chỉ thêm foreign key nếu chưa tồn tại
        Schema::table('users', function (Blueprint $table) {
            // Nếu đã có foreign key thì bỏ qua
            // Laravel không hỗ trợ kiểm tra trực tiếp, nên khuyến nghị kiểm tra thủ công hoặc xóa foreign key trùng lặp trong DB trước khi migrate
            try {
                $table->foreign('user_catalogue_id')->references('id')->on('user_catalogues');
            } catch (\Exception $e) {
                // Nếu lỗi do đã tồn tại thì bỏ qua
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_catalogue_id']);
        });
    }
};
