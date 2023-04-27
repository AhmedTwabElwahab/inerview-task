<?php

namespace App\Models;


use App\Http\Requests\OfferRequest;
use Exception;
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
 * @method static paginate(int $APP_PAGINATE)
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

    /**
     * Create A new offer.
     *
     * @param OfferRequest $request
     * @return Offer
     * @throws Exception
     */
    public static function createOffer(OfferRequest $request): Offer
    {
        if (empty($request->input('product_id')))
        {
            throw new Exception('add_discount',APP_ERROR);
        }
        if ($request->input('end_date') < now())
        {
            throw new Exception('end_date_failed',APP_ERROR);
        }
        $offer = new Offer();
        $offer->name       = $request->input('name');
        $offer->desc       = $request->input('desc');
        $offer->end_date   = $request->input('end_date');

        if (!$offer->save())
        {
            throw new Exception('error',APP_ERROR);
        }
        return $offer;
    }

    /**
     * Create Discount.
     *
     * @param OfferRequest $request
     * @return true
     * @throws Exception
     */
    public function handelCreateDiscount(OfferRequest $request): bool
    {
        if (! $request->has('product_id'))
        {
            throw new Exception('error',APP_ERROR);
        }
        foreach ($request->input('product_id') as $index => $id)
        {
            $discount = new Discount();

            $discount->offer_id                     = $this->id;
            $discount->product_id                   = $id;
            $discount->discount_value               = $request->input('discount_value')[$index];
            $discount->min_order_value              = $request->input('min_order_value')[$index];
            $discount->discount_type_id             = $request->input('discount_type_id')[$index];

            $discount->save();
        }
        return SUCCESS;
    }
}
