<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // FK đến bảng users
            $table->foreignId('coupon_id')->constrained()->onDelete('cascade'); // FK đến bảng coupons
            $table->integer('usage_count')->default(0); // Số lần đã dùng
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_coupons');
    }
};
