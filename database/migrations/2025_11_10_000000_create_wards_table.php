<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->string('name');
            $table->string('district_code');
            $table->foreign('district_code')->references('code')->on('districts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wards');
    }
};
