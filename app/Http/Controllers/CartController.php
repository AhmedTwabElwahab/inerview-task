<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
}
