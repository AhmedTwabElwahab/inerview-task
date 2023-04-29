<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

    /**
     * display invoice.
     *
     * @return RedirectResponse|View
     */
    public function invoice(): RedirectResponse |View
    {
        $this->init();
        DB::beginTransaction();
        try
        {
            $Cart      = Cart::currentCart();
            $discounts =  $Cart->getDiscount();

            if ($Cart->items->isEmpty() == SUCCESS)
            {
                throw new Exception('cart is empty!',APP_ERROR);
            }
            DB::commit();

            return $this->view(compact('Cart','discounts'));
        }catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            $this->setSystemMessage($message);
            return redirect()->back()->withInput();
        }
    }
}
