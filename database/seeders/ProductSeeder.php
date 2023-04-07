<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name'                  => 'Shoes Nike',
                'category_id'           => 6,
                'barcode'               => 15,
                'quantity_in_Stock'     => 84,
                'weight'                => 0.8,
                'vat'                   => 14,
                'price'                 => 3,
                'image'                 => PRODUCTS_IMG_FOLDER.'1.jpg',
            ],
            [
                'name'                  => 'red T-shirt',
                'category_id'           => 1,
                'barcode'               => 16,
                'quantity_in_Stock'     => 6,
                'weight'                => 0.2,
                'vat'                   => 14,
                'price'                 => 8,
                'image'                 => PRODUCTS_IMG_FOLDER.'2.jpg',
            ],
            [
                'name'                  => 'Blouse',
                'category_id'           => 2,
                'barcode'               => 96,
                'quantity_in_Stock'     => 4,
                'weight'                => 0.3,
                'vat'                   => 14,
                'price'                 => 71,
                'image'                 => PRODUCTS_IMG_FOLDER.'1.jpg',
            ],
            [
                'name'                  => 'Jacket',
                'category_id'           => 5,
                'barcode'               => 74,
                'quantity_in_Stock'     => 9,
                'weight'                => 0.96,
                'vat'                   => 14,
                'price'                 => 105.99,
                'image'                 => PRODUCTS_IMG_FOLDER.'2.jpg',
            ],
            [
                'name'                  => 'Jacket bee',
                'category_id'           => 5,
                'barcode'               => 678,
                'quantity_in_Stock'     => 46,
                'weight'                => 0.86,
                'vat'                   => 14,
                'price'                 => 98,
                'image'                 => PRODUCTS_IMG_FOLDER.'2.jpg',
            ],

        ]);
    }
}
