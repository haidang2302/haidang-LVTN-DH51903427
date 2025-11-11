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
            if (!Schema::hasColumn('products', 'code')) {
                $table->string('code')->default('0');
            }
            if (!Schema::hasColumn('products', 'made_in')) {
                $table->string('made_in')->nullable();
            }
            if (!Schema::hasColumn('products', 'price')) {
                $table->double('price', 8, 2)->default('0');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('made_in');
            $table->dropColumn('price');
        });
    }
};
