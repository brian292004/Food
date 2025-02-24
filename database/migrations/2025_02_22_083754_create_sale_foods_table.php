<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sale_foods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->onDelete('cascade'); // FK đến bảng sales
            $table->foreignId('food_id')->constrained()->onDelete('cascade'); // FK đến bảng food
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_foods');
    }
};
