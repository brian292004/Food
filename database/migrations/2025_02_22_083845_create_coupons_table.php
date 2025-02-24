<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code')->unique(); // Mã giảm giá
            $table->text('coupon_description')->nullable(); // Mô tả
            $table->decimal('discount_percent', 5, 2)->nullable(); // Giảm theo %
            $table->decimal('discount_amount', 10, 2)->nullable(); // Giảm cố định
            $table->integer('usage_limit')->default(1); // Giới hạn số lần sử dụng
            $table->dateTime('start_time'); // Ngày bắt đầu
            $table->dateTime('end_time'); // Ngày hết hạn
            $table->boolean('is_active')->default(true); // Trạng thái hoạt động
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
