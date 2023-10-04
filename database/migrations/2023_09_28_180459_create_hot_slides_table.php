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
        Schema::create('hot_slides', function (Blueprint $table) {
            $table->id();
            $table->string("image");
            $table->foreignId("product_id")->nullable();
            $table->string("url")->nullable();
            $table->enum("is_show",[0,1])->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hot_slides');
    }
};
