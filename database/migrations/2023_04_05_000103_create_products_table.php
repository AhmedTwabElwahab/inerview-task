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
            $table->unsignedBigInteger('quantity_in_Stock');
            $table->decimal('weight',8,2,true);
            $table->decimal('vat',8,2,true);
            $table->decimal('price',8,2,true);
            //TODO::Discount id
            $table->string('image');
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
