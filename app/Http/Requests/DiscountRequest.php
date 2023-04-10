<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class DiscountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function onUpdate(): array
    {
        return [
            'offer_id'             => 'required|numeric|exists:offers,id',
            'product_id'           => 'required|numeric|exists:products,id',
            'discount_value'       => 'required|numeric|min:0',
            'min_order_value'      => 'required|numeric|min:1',
            'discount_type_id'     => 'required|numeric|exists:discount_types,id',
        ];
    }
    protected function onCreate(): array
    {
        return [
            'offer_id'             => 'required|numeric|exists:offers,id',
            'product_id'           => 'required|numeric|exists:products,id',
            'discount_value'       => 'required|numeric|min:0',
            'min_order_value'      => 'required|numeric|min:1',
            'discount_type_id'     => 'required|numeric|exists:discount_types,id',
        ];
    }
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ?
            $this->onUpdate() : $this->onCreate();
    }
}
