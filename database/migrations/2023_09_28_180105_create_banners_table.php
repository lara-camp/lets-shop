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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string("image");
            $table->text("description")->nullable();
            $table->enum("banner_type", ["flashsale", "coupon", "event",'coupon_detail']);
            $table->enum("section",['home','coupon'])->nullable();
            $table->string('page_section');
            $table->string("url")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
