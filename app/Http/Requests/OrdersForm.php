<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdersForm extends FormRequest
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
            'order_lat' => 'required',
            'order_long' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'order_long.required' => 'Order Latitude Wanted!',
            'order_lat.required' => 'Order Longitude Wanted!',

        ];
    }
}
