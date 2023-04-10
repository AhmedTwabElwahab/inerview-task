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
        Schema::create('discounts', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('offer_id');
            /**
             * if product_id equal NULL this offer for all products
             */
            $table->foreignId('product_id')->nullable();
            $table->unsignedDecimal('discount_value');
            $table->unsignedInteger('min_order_value');
            $table->foreignId('discount_type_id');
            $table->timestamps();


            $table->foreign('offer_id')->references('id')->on('offers');
            $table->foreign('discount_type_id')->references('id')->on('discount_types');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
