<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Contracts\View\View;


class CartController extends Controller
{

    /**
     * Display user cart.
     *
     * @return View
     */
    public function show(): View
    {
        $this->init();
        $Cart = Cart::currentCart();
        return $this->view(compact('Cart'));
    }

    public function invoice(): View
    {
        $this->init();
        $Cart = Cart::currentCart();
        $discounts =  $Cart->getDiscount();

        return $this->view(compact('Cart','discounts'));
    }

    /**
     * Delete category.
     *
     * @param CartItem $Item
     *
     */
}
