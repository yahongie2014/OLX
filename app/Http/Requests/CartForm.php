<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartForm extends FormRequest
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
            'product_id' => 'required|integer|exists:products,id',
            'qty' => 'required|integer|max:20',
        ];
    }
    public function messages()
    {
        return [
            'product_id.required' => 'Product ID Required!',
            'product_id.integer' => 'Product ID must be integer!',
            'qty.integer' => 'Quantity must be integer!',
            'qty.required' => 'Quantity required!',

        ];
    }
}
