<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Models\CartItem;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class CartItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CartItemRequest $request
     * @return bool
     */
    public function store(CartItemRequest $request): bool
    {
        $this->init();
        DB::beginTransaction();
        try
        {
            if (CartItem::addItem($request) == FAILED)
            {
                throw new Exception('error', APP_ERROR);
            }
            DB::commit();
            return SUCCESS;
        }catch (Exception $e)
        {
            DB::rollBack();
            return FAILED;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CartItemRequest $request
     * @param CartItem $CartItem
     * @return RedirectResponse
     */
    public function update(CartItemRequest $request, CartItem $CartItem): RedirectResponse
    {
        $this->init();
        DB::beginTransaction();
        try
        {
            $CartItem->update($request->all());

            if ($CartItem->save())
            {
                throw new Exception('error',APP_ERROR);
            }

            DB::commit();
            $this->success('success');
            return redirect()->route('showCart');
        }catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            $this->setSystemMessage($message);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CartItem $CartItem
     * @return RedirectResponse
     */
    public function destroy(CartItem $CartItem): RedirectResponse
    {
        $this->init();
        DB::beginTransaction();
        try
        {
            if ($CartItem->delete() == FAILED)
            {
                throw new Exception('error' ,APP_ERROR);
            }
            DB::commit();
            $this->success('success');
            return redirect()->route('cart.show');
        } catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            $this->setSystemMessage($message);
            return redirect()->back();
        }
    }
}
