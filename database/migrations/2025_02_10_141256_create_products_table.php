<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade'); // FK Nhà hàng
            $table->string('name'); // Tên món ăn
            $table->text('description')->nullable(); // Mô tả
            $table->decimal('price', 10, 2); // Giá món ăn
            $table->string('image')->nullable(); // Ảnh món ăn
            $table->boolean('is_featured')->default(false); // Đánh dấu món ăn nổi bật
            $table->integer('sold_count')->default(0); // Số lần bán ra
            $table->integer('total_feedbacks')->default(0); // Tổng số feedback
            $table->decimal('average_rating', 2, 1)->default(0); // Đánh giá trung bình
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
