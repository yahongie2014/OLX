<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Foundation\Http\FormRequest;

class ProductsForm extends FormRequest
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
            'name' => 'required|string|max:50',
            'desc' => 'required|string|max:255',
            'price' => 'required|integer',
            'cover_image' => 'required',
            'is_active' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'desc.required' => 'Info is required!',
            'price.integer' => 'Price must be integer!',
            'price.required' => 'Price cannot be null!',
            'is_active.required' => 'Status is Required!',
            'cover_image.required' => 'Cover Image is Required!',
        ];
    }
}
