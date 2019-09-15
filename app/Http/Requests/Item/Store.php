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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shopping_list_id' => ['required', 'integer', 'exists:shopping_lists,id'],
            'product_id'       => ['required', 'integer', 'exists:products,id'],
            'unit_id'          => ['nullable', 'integer', 'exists:units,id'],
            'amount'           => ['integer'],
            'done'             => ['required', 'boolean'],
        ];
    }
}
