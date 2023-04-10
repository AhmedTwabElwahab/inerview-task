<?php

namespace Tests\Feature;

use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\traits\LoginTest;
use Tests\TestCase;

class CartTest extends TestCase
{
    use LoginTest;

    /**
     * test create a new cartItem.
     *
     * @return void
     */
    public function test_show_cart()
    {
        $this->test_login();

        $response = $this->get('/cart');

        $response->assertStatus(200);
    }

    public function test_show_invoice()
    {
        $this->test_login();

        $response = $this->get('/cart/invoice');

        $response->assertStatus(200);
    }

    /**
     * test create a new cart.
     *
     * @return void
     */
    public function test_create_cart()
    {
        $this->test_login();

        $cart = Cart::currentCart();

        $this->assertIsObject($cart);
    }

}
