<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('category_id');
            $table->string('barcode',20);
            $table->string('name');
            $table->string('desc');
            $table->unsignedBigInteger('quantity_in_Stock');
            $table->unsignedDecimal('weight'); //by KG
            $table->unsignedDecimal('price');
            $table->string('image')->default(DEFAULT_IMG);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
