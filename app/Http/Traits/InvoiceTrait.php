<?php

namespace App\Http\Traits;


use App\Models\CartItem;
use App\Models\Discount;
use App\Models\Offer;
use App\Models\User;

trait InvoiceTrait
{

    /**
     * initialize Value.
     *
     * @return void
     */
    public function initializeInvoice(): void
    {
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
        $arr    = [];
        $offers = Offer::all();

        foreach ($offers as $offer)
        {
            //check if offer global.
            if ($offer->shopping_rate_offer)
            {
                $global = $this->handelGlobalOffer($offer);
                if (!empty($global))
                {
                    $arr[] = $global;
                }
            }

            //if greater than 2 this is compound offer
            if (count($offer->discounts) < 2)
            {
                $normal = $this->handelNormalDiscount($offer);
                if (!empty($normal))
                {
                    $arr[] = $normal;
                }
            }
            else
            {
                $compound_offer = $this->handelCompoundOffer($offer);
                if (!empty($compound_offer))
                {
                    $arr[] = $compound_offer;
                }
            }
        }
        $this->initializeInvoice();
        return $arr;
    }

    /**
     * handel normal offer.
     *
     * @param Offer $offer
     * @return array
     */
    protected function handelNormalDiscount(Offer $offer):array
    {
        foreach ($offer->discounts as $discount)
        {
            foreach ($this->items as $item)
            {
                if ($discount->product_id === $item->product_id)
                {
                    $value = $this->checkDiscount($discount, $item);

                    if ($value !== FAILED)
                    {
                        $this->totalDiscount += $value * $item->quantity;
                        return [
                            'value' => $value * $item->quantity,
                            'obj'   => $offer
                        ];
                    }
                }
            }
        }
        return [];
    }

    /**
     * handel compound offer.
     *
     * @param Offer $offer
     * @return array
     */
    protected function handelCompoundOffer(Offer $offer):array
    {
        $counter       = 0;
        $totalDiscount = 0;

        foreach ($offer->discounts as $discount)
        {
            foreach ($this->items as $item)
            {
                if ($discount->product_id == $item->product_id)
                {
                    $value = $this->checkDiscount($discount, $item);

                    if ($value !== FAILED)
                    {
                        $totalDiscount += $value;
                        $counter       += 1;
                    }
                }
            }
        }

        if ($counter == count($offer->discounts))
        {
            //TODO::handel multi request
            $this->totalDiscount += $totalDiscount;
            return [
                'value'   => $totalDiscount,
                'obj'     => $offer
            ];
            $counter       = 0;
            $totalDiscount = 0;
        }
        return [];
    }

    /**
     * handel Global discount.
     *
     * @param Offer $offer
     * @return array
     */
    protected function handelGlobalOffer(Offer $offer): array
    {
        /**
         * Global offer must be content only one Discount.
         * @var Discount $global_dis
         */
        $global_dis = $offer->discounts->first();

        if ($global_dis->min_order_value <= count($this->items))
        {
            //check if discount is expired
            if ($offer->end_date <= now())
            {
                // check if type of discount PERCENT or CASH
                if ($global_dis->type->id == PERCENT)
                {
                    // inital value
                    if ($this->subtotal == 0)
                    {
                        $this->initializeInvoice();
                    }
                    //return discount value
                    $this->totalDiscount += ($global_dis->discount_value / 100) * $this->subtotal;
                    return [
                        'value' => ($global_dis->discount_value / 100) * $this->subtotal,
                        'obj'   => $offer
                    ];
                } else
                {
                    $this->totalDiscount += $global_dis->discount_value;
                    return [
                        'value' =>  $global_dis->discount_value,
                        'obj'   =>  $offer
                    ];
                }
            }
        }
        return [];
    }
    /**
     * check valid Discount
     *
     * @param Discount $discount
     * @param CartItem $item
     * @return bool|float|int
     */
    public function checkDiscount(Discount $discount, CartItem $item): bool|float|int
    {
        //check if We have reached the required discount limit
        if ($discount->min_order_value <= $item->quantity)
        {
            //check if discount is expired
            if ($discount->offer->end_date <= now())
            {
                // check if type of discount PERCENT or CASH
                if ($discount->type->id == PERCENT)
                {
                    //return discount value
                    return ($discount->discount_value / 100) * $item->product->price;
                } else {
                    return $discount->discount_value;
                }
            }
        }
        return FAILED;
    }


    /**
     * get Total invoice.
     *
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * get subtotal.
     *
     * @return float
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    /**
     * get rate.
     *
     * @return float
     */
    public
    function getShoppingRate(): float
    {
        return $this->shoppingRate;
    }

    /**
     * get VAT.
     *
     * @return float
     */
    public
    function getVat(): float
    {
        return $this->vat;
    }
}
