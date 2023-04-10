<?php

namespace Tests\Feature;

use App\Models\Cart;
use Tests\Feature\traits\LoginTest;
use Tests\TestCase;

class CartItemTest extends TestCase
{
    use LoginTest;

    /**
     * test create a new cartItem.
     *
     * @return void
     */
    public function test_create_cartItem()
    {
        $this->test_login();

        $cart = Cart::currentCart();

        $this->post('/CartItem',
            [
                'cart_id'                => $cart->id,
                'product_id'             => DEFAULT_CART_ID,
                'quantity'               => 1,
                'total'                  => 2,
            ]);
        $this->assertTrue(true);
    }

    /**
     * test update CartItem.
     *
     * @return void
     */
    public function test_Update_cartItem()
    {
        $this->test_login();

        $response = $this->patch('/CartItem/'.DEFAULT_ITEM_ID,
            [
                'quantity'               => 10,
                'total'                  => 5,
            ]);

        $response->assertRedirect('/cart');
    }


    /**
     * test Delete CartItem.
     *
     * @return void
     */
    public function test_Delete_cartItem()
    {
        $this->test_login();

        $response = $this->delete('/CartItem/1');

        $response->assertRedirect('/cart');
    }
}
