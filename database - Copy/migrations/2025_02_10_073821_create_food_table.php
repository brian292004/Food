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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('food_name');
            $table->text('food_description')->nullable(); // Mô tả
            $table->decimal('food_price', 10, 2); // Giá món ăn
            $table->string('food_image');
            $table->boolean('food_is_featured')->default(false); // Đánh dấu món ăn nổi bật
            $table->integer('food_sold_count')->default(0); // Số lần bán ra
            $table->integer('food_total_feedbacks')->default(0); // Tổng số feedback
            $table->decimal('food_average_rating', 2, 1)->default(0);
            $table->foreignId('shop_id')->constrained()->onDelete('cascade'); // FK Nhà hàng
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
