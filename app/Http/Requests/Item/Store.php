<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'product_name'     => ['required', 'string'],
            'unit_name'        => ['nullable', 'string'],
            'amount'           => ['nullable', 'numeric'],
            'done'             => ['required', 'boolean'],
        ];
    }
}
