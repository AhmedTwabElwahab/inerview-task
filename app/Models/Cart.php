<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Cart
 * @package App\Models
 *
 * @property int    $id
 * @property int    $total
 * @property int    $user_id
 *
 * RELATIONS PROPERTIES
 * @property CartItem[] $items
 * @property Cart       $currentCart
 *
 * @method static where(string $string, mixed $id)
 */
class Cart extends Model
{
    use HasFactory;

    protected float $subtotal;
    protected float $shoppingRate;
    protected float $vat;
    protected float $totalDiscount;
    protected float $total;

    public function __construct()
    {
        $this->subtotal         = 0;
        $this->shoppingRate     = 0;
        $this->vat              = 0;
        $this->totalDiscount    = 0;
        $this->total            = 0;
    }
    /**
     * create Cart.
     *
     * @param int $user_id
     * @return Cart|false
     */
    public static function createCart(int $user_id): bool|Cart
    {
        $cart = new Cart();

        $cart->user_id = $user_id;

        if ($cart->save())
        {
            return $cart;
        }
        return FAILED;
    }

    /**
     * Get current cart.
     *
     * @return Cart
     */
    public static function currentCart():Cart
    {
        $cart = Cart::where('user_id', User::activeUser()->id)->first();
        if (!$cart)
        {
            $NewCart = self::createCart(User::activeUser()->id);

            if ($NewCart !== FAILED)
            {
                return $NewCart;
            }
        }
        return $cart;
    }

    /**
     * initialize Value.
     *
     * @return void
     */
    public function initializeInvoice(): void
    {
        $this->subtotal = 0;
        $this->shoppingRate = 0;
        $this->total = 0;
        foreach ($this->items as $item)
        {
            $this->subtotal += $item->total;
            // weight using KG
            // Each country has a shipping rate per 100 grams
            // if rate $2 per 0.1kg (2 * 0.1) * 10 = 2$.
            $this->shoppingRate += ($item->product->weight) * (User::activeUser()->country->shipping_rate * 10);
        }
        // VAt init
        $this->vat = $this->subtotal * (VAT / 100);


        $this->total = ($this->subtotal + $this->shoppingRate + $this->vat) - $this->totalDiscount;
    }

    /**
     * Get all discount.
     *
     * @return array
     */
    public function getDiscount(): array
    {
        $arr = [];

        $this->initializeInvoice();

        foreach ($this->items as $item)
        {
            if ($item->product->discount !== null)
            {
                if ($item->product->discount->min_order_value <= $item->quantity)
                {
                    if ($item->product->discount->offer->end_date <= now())
                    {
                       if ($item->product->discount->type->id == PERCENT)
                       {
                          $value =  ($item->product->discount->discount_value / 100) *  $item->product->price;
                       } else
                       {
                           $value = $item->product->discount->discount_value;
                       }

                       if ($value > 0)
                       {
                           $arr[] = [
                               'name'  => $item->product->discount->offer->name,
                               'value' => $value,
                               'obj'   => $item->product->discount,
                           ];
                           $this->totalDiscount += $value;
                       }
                    }
                }
            }
        }

        /**
         * get global discount
         *
         * @var Discount $discountAllProducts
         */
        $discountAllProducts = Discount::where('product_id',null)->first();

        if ($discountAllProducts->min_order_value <= count($this->items))
        {
            if ($discountAllProducts->offer->end_date <= now())
            {
                if ($discountAllProducts->type->id == PERCENT)
                {
                    $value =  ($discountAllProducts->discount_value / 100) * $this->subtotal;
                }else
                {
                    $value =  $discountAllProducts->discount_value;
                }
            }

            if ($value > 0)
            {
                $arr[] = [
                    'name' => $discountAllProducts->offer->name,
                    'value' => $value,
                    'obj' => $discountAllProducts,
                ];
                $this->totalDiscount += $value;
            }

        }
        $this->initializeInvoice();

        return $arr;
    }

    /**
     * get Total invoice.
     *
     * @return float
     */
    public function getTotal():float
    {
        return $this->total;
    }

    /**
     * get subtotal.
     *
     * @return float
     */
    public function getSubtotal():float
    {
        return $this->subtotal;
    }

    /**
     * get rate.
     *
     * @return float
     */
    public function getShoppingRate():float
    {
        return $this->shoppingRate;
    }

    /**
     * get VAT.
     *
     * @return float
     */
    public function getVat():float
    {
        return $this->vat;
    }

    /**
     * Get all Item inside shopping Cart.
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class,'cart_id','id');
    }


}
