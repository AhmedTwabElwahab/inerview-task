<?php

namespace Tests\Feature;

use Tests\Feature\traits\LoginTest;
use Tests\TestCase;

class categoryTest extends TestCase
{
    use LoginTest;

    /**
     * test show categories.
     *
     * @return void
     */
    public function test_Category_Show()
    {
        $this->test_login();

        $response = $this->get('/category');

        $response->assertStatus(200);

    }

    /**
     * test create a new category.
     *
     * @return void
     */
    public function test_create_category()
    {
        $this->test_login();

        $response = $this->post('/category',
            [
                'name'                  => 'Shoes_nike',
            ]);
        $response->assertRedirect('/category');
    }

    /**
     * test update category.
     *
     * @return void
     */
    public function test_Update_product()
    {
        $this->test_login();

        $response = $this->patch('/category/'.PRODUCT_ID,
            [
                'name'                  => 'Shoes_NK',
            ]);
        $response->assertRedirect('/category');
    }
}
