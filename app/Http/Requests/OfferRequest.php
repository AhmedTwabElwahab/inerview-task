<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function onUpdate(): array
    {
        return [
            'name'                    => 'required|string|max:255',
            'desc'                    => 'required|string|max:255',
            'end_date'                => 'required|date',
            'shopping_rate_offer'     => 'sometimes|nullable|bool',
        ];
    }
    protected function onCreate(): array
    {
        return [
            'name'                    => 'required|string|max:255',
            'desc'                    => 'required|string|max:255',
            'end_date'                => 'required|date|after:'.now(),
            'shopping_rate_offer'     => 'sometimes|nullable|bool',
        ];
    }
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ?
            $this->onUpdate() : $this->onCreate();
    }
}
