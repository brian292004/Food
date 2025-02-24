<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sale_shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->onDelete('cascade'); // FK đến bảng sales
            $table->foreignId('shop_id')->constrained()->onDelete('cascade'); // FK đến bảng shops
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_shops');
    }
};
