<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum("status", ["pending", "approve", "disapprove"]);
            $table->double("unit_price");
            $table->integer("quantity");
            $table->double("total_price");
            $table->foreignId("flash_discount_id")->nullable();
            $table->double("grand_price");
            $table->foreignId("product_id");
            $table->foreignId("user_id");
            $table->foreignId("payment_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
