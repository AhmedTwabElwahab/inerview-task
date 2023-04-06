<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class CartItem
 * @package App\Models
 *
 * @property int    $id
 * @property int    $quantity
 *
 * RELATIONS PROPERTIES
 * @property Product $product
 * @property Cart    $cart
 *
 */
class CartItem extends Model
{
    use HasFactory;

    /**
     * Get Cart belong to item
     *
     * @return HasOne
     */
    public function cart(): HasOne
    {
        return $this->HasOne(Cart::class,'id','cart_id');
    }

    /**
     * Get product from Item Cart
     *
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->HasOne(Product::class,'id','product_id');
    }
}
