<?php

namespace App\Http\Requests\Product;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['string', Rule::unique('products')
                ->ignore($this->product)
                ->where(function ($query) {
                    return $query
                        ->whereOwnerEmail(auth()->id())
                        ->orWhereNull('owner_email');
                })],
        ];
    }
}
