<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\traits\LoginTest;
use Tests\TestCase;

class OfferTest extends TestCase
{
    use LoginTest;

    /**
     * test show Offers.
     *
     * @return void
     */
    public function test_Offer_Show()
    {
        $this->test_login();

        $response = $this->get('/offer');

        $response->assertStatus(200);
    }

    /**
     * test create a new offer.
     *
     * @return void
     */
    public function test_create_offer()
    {
        $this->test_login();

        $response = $this->post('/offer',
            [
                'name'                  => 'Shoes_nike 10% for free',
                'desc'                  => 'Shoes_nike',
                'end_date'              =>  '2024/8/12',
                'shopping_rate_offer'   => false,
                  /***** Discount props *****/
                'product_id'            =>  [DEFAULT_PRODUCT_ID],
                'discount_value'        =>  [10],
                'min_order_value'       =>  [1],
                'discount_type_id'     =>  [CASH],
            ]);
        $response->assertRedirect('/offer');
    }
}
