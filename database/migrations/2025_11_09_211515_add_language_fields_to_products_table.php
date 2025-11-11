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
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->nullable()->after('qrcode');
            $table->string('canonical')->nullable()->after('name');
            $table->text('description')->nullable()->after('canonical');
            $table->longText('content')->nullable()->after('description');
            $table->string('meta_title')->nullable()->after('content');
            $table->string('meta_keyword')->nullable()->after('meta_title');
            $table->text('meta_description')->nullable()->after('meta_keyword');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['name', 'canonical', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description']);
        });
    }
};
