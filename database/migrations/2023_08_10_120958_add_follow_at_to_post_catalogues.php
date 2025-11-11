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
        // Migration này đã được vô hiệu hóa do không cần bảng post_catalogues
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_catalogues', function (Blueprint $table) {
            $table->dropColumn('follow');
        });
    }
};
