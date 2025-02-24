<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sale_name'); // Tên chương trình khuyến mãi
            $table->text('sale_description')->nullable(); // Mô tả chi tiết
            $table->decimal('discount_percent', 5, 2)->nullable(); // Giảm giá theo %
            $table->decimal('discount_amount', 10, 2)->nullable(); // Giảm giá cố định
            $table->boolean('is_active')->default(true); // Trạng thái hoạt động
            $table->dateTime('start_time'); // Ngày bắt đầu
            $table->dateTime('end_time'); // Ngày kết thúc
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
