<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @property mixed $barcode
 */
class CartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function onUpdate(): array
    {
        return [
            'quantity'          => 'required|numeric|min:1',
        ];
    }
    protected function onCreate(): array
    {
        return [
            'cart_id'           => 'sometimes|nullable|numeric|exists:cart,id',
            'product_id'        => 'required|numeric|exists:products,id',
            'quantity'          => 'required|numeric|min:1',
        ];
    }
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ?
            $this->onUpdate() : $this->onCreate();
    }
}
