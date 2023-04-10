<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @property mixed $barcode
 */
class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function onUpdate(): array
    {
        return [
            'category_id'       => 'required|numeric|exists:categories,id',
            'barcode'           => 'required|string',
            'name'              => 'required|string|max:255',
            'desc'              => 'required|string|max:255',
            'quantity_in_Stock' => 'required|numeric|min:0',
            'weight'            => 'required|numeric|min:0.01',
            'price'             => 'required|numeric|min:0',
            'image'             => 'sometimes|nullable|string',
        ];
    }
    protected function onCreate(): array
    {
        return [
            'category_id'       => 'required|numeric|exists:categories,id',
            'barcode'           => 'required|string',
            'name'              => 'required|string|max:255',
            'desc'              => 'required|string|max:255',
            'quantity_in_Stock' => 'required|numeric|min:0',
            'weight'            => 'required|numeric|min:0.01',
            'price'             => 'required|numeric|min:0',
            'image'             => 'sometimes|nullable|string',
        ];
    }
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ?
            $this->onUpdate() : $this->onCreate();
    }
}
