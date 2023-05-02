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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 255);
            $table->string('product_short_name', 255);
            $table->string('sku', 25);
            $table->double('price', 8,2)->nullable()->default(0);
            $table->integer('quantity', 8,2)->nullable()->default(0);
            $table->longText('product_description')->nullable();
            $table->tinyInteger('product_del_flg')->default(0);
            $table->unsignedBigInteger('store_id');
            $table->timestamps();
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
