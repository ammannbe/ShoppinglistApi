<?php

namespace App\Http\Requests\ShoppingList;

use Illuminate\Validation\Rule;
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
            'name' => ['required', 'string', Rule::unique('shopping_lists')->where(function ($query) {
                return $query->whereOwnerEmail(auth()->id());
            })],
        ];
    }
}
