<?php

namespace App\Models;

use App\Http\Traits\InvoiceTrait;
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
    use HasFactory,InvoiceTrait;

    protected float $subtotal;
    protected float $shoppingRate;
    protected float $vat;
    protected float $totalDiscount;
    protected float $total;
    protected array $offer;

    public function __construct()
    {
        $this->subtotal         = 0;
        $this->shoppingRate     = 0;
        $this->vat              = 0;
        $this->totalDiscount    = 0;
        $this->total            = 0;
        $this->offer            = [];
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
     * if cart not fount func create it.
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
     * Get all Item inside shopping Cart.
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class,'cart_id','id');
    }
}
