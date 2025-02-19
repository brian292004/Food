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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->string('shop_address');
            $table->string('shop_phone');
            $table->string('shop_email');
            $table->string('shop_logo')->nullable();
            $table->string('shop_status')->nullable();
            $table->string('shop_support_email')->unique();
            $table->string('shop_support_messenger')->nullable(); // Thêm trường SupportMessenger
            $table->text('shop_description')->nullable();
            $table->float('shop_rating')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
