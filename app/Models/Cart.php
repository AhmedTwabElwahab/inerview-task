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

    /**
     * Get all Item inside shopping Cart.
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class,'cart_id','id');
    }

    /**
     * Get current cart.
     *
     * @return Cart
     */
    public static function currentCart():Cart
    {
        return Cart::where('user_id', User::activeUser()->id)->first();
    }
}
