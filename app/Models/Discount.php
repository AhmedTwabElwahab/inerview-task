<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Discount
 * @package App\Models
 *
 * @property int            $id
 * @property int            $discount_value
 * @property int            $min_order_value
 *
 * RELATIONS PROPERTIES
 * @property Product        $product
 * @property Offer          $offer
 * @property discountType   $type
 */
class Discount extends Model
{
    use HasFactory;


    /**
     * Get product from Item Cart
     *
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->HasOne(Product::class,'id','product_id');
    }

    /**
     * Get offer to which the discount belongs
     *
     * @return HasOne
     */
    public function offer(): HasOne
    {
        return $this->HasOne(Offer::class,'id','offer_id');
    }

    /**
     * Get Type of discount
     *
     * @return HasOne
     */
    public function type(): HasOne
    {
        return $this->HasOne(discountType::class,'id','discount_type_id');
    }
}
