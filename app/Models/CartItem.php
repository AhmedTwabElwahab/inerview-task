<?php

namespace App\Models;

use App\Http\Requests\CartItemRequest;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;

/**
 * Class CartItem
 * @package App\Models
 *
 * @property int $id
 * @property int $cart_id
 * @property int $product_id
 * @property int $quantity
 * @property int $total
 *
 * RELATIONS PROPERTIES
 * @property Product $product
 * @property Cart $cart
 *
 * @method static where(string $string, mixed $cart_id)
 * @method static find(mixed $index)
 */
class CartItem extends Model
{
    use HasFactory;

    protected $guarded = [];


    /**
     * add a new cart Item.
     *
     * @param CartItemRequest $request
     * @return bool
     * @throws Exception
     */
    public static function addItem(CartItemRequest $request): bool
    {
        $product_id = $request->input('product_id');
        $quantity   = $request->input('quantity');
        $total      = $request->input('total');
        $cart_id    = $request->input('cart_id') === null ? Cart::currentCart()->id : $request->input('cart_id');

        // check if item exists
        $item_exists = (new CartItem)->itemExists($cart_id, $product_id);

        if ($item_exists === false)
        {   // create a new one.
            $item = new CartItem();

            $item->cart_id    = $cart_id;
            $item->product_id = $product_id;
            $item->quantity   = $quantity;
            $item->total      = $total;

            if (!$item->save())
            {
                throw new Exception('error', APP_ERROR);
            }
            return SUCCESS;
        }

        // update quantity.
        return $item_exists->update(
            [
                'quantity' => $item_exists->quantity + $quantity,
                'total'    => $item_exists->product->price * ( $item_exists->quantity + $quantity ),
            ]
        );
    }

    /**
     * update cartItem before launch invoice.
     *
     * @param Request $request
     * @return bool
     */
    public static function updateCartItem(Request $request): bool
    {
        if (!$request->has('item_id') && $request->input('type'))
        {
            return FAILED;
        }
        $item = $request->input('item_id');
        $type = $request->input('type');

        $item_ex =  CartItem::find(intval($item));

        if ($item_ex == null)
        {
            return FAILED;
        }
        if ($type === QTY_INC)
        {
            return $item_ex->update(
            [
                'quantity' => $item_ex->quantity + 1,
                'total'    => ($item_ex->quantity + 1) * $item_ex->product->price,
            ]);
        }
        else
        {
            return $item_ex->update(
            [
                'quantity' => ($item_ex->quantity - 1),
                'total'    => ($item_ex->quantity - 1) * $item_ex->product->price,
            ]);
        }
    }

    /**
     * Search in cartItem table if this item exists or not.
     *
     * @param int $cart_id
     * @param int $item_id
     * @return bool|CartItem
     */
    protected function itemExists(int $cart_id, int $item_id): bool|CartItem
    {
        $items = CartItem::where('cart_id', $cart_id)->get();

        if ($items) {
            foreach ($items as $item) {
                if ($item->product_id === $item_id) {
                    return $item;
                }
            }
        }
        return FAILED;
    }

    /**
     * Get Cart belong to item
     *
     * @return HasOne
     */
    public function cart(): HasOne
    {
        return $this->HasOne(Cart::class, 'id', 'cart_id');
    }

    /**
     * Get product from Item Cart
     *
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->HasOne(Product::class, 'id', 'product_id');
    }
}
