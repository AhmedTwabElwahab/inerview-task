<?php

namespace Tests\Feature;

use Tests\Feature\traits\LoginTest;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use LoginTest;

    /**
     * test show product.
     *
     * @return void
     */
    public function test_ProductShow()
    {
        $this->test_login();

        $response = $this->get('/product');

        $response->assertStatus(200);

    }

    /**
     * test create a new product.
     *
     * @return void
     */
    public function test_create_product()
    {
        $this->test_login();

        $response = $this->post('/product',
        [
            'name'                  => 'Shoes_nike',
            'desc'                  => 'Shoes Nike',
            'category_id'           => 6,
            'barcode'               => '622500101447685',
            'quantity_in_Stock'     => 80,
            'weight'                => 0.8,
            'price'                 => 3,
            'image'                 => PRODUCTS_IMG_FOLDER.'4.jpg',
        ]);
        $response->assertRedirect('/product');
    }

    /**
     * test update a product.
     *
     * @return void
     */
    public function test_Update_product()
    {
        $this->test_login();

        $response = $this->patch('/product/'.PRODUCT_ID,
            [
                'name'                  => 'Shoes_nike',
                'desc'                  => 'Shoes Nike',
                'category_id'           => 6,
                'barcode'               => '622500101447685',
                'quantity_in_Stock'     => 80,
                'weight'                => 0.8,
                'price'                 => 3,
                'image'                 => PRODUCTS_IMG_FOLDER.'4.jpg',
            ]);
        $response->assertRedirect('/product');
    }
}
