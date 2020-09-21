<?php

namespace App\Http\Requests\Item;

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
            'product_id'       => ['integer', 'exists:products,id'],
            'unit_id'          => ['nullable', 'integer', 'exists:units,id'],
            'amount'           => ['nullable', 'numeric'],
            'done'             => ['boolean'],
        ];
    }
}
