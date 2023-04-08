<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Offer
 * @package App\Models
 *
 * @property int       $id
 * @property string    $name
 * @property string    $desc
 * @property string    $end_date
 * @property boolean   $shopping_rate_offer
 *
 * RELATIONS PROPERTIES
 * @property Discount[] $discounts
 *
 */
class Offer extends Model
{
    use HasFactory;

    /**
     * Get all discounts inside shopping offer
     *
     * @return HasMany
     */
    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class,'offer_id','id');
    }
}
