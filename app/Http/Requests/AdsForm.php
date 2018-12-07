<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsForm extends FormRequest
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
            'is_active' => 'required|integer',
            'subservices_id' => 'required|integer',
            'services_id' => 'required|integer',
            'desc' => 'required|max:255',
            'is_delivery' => 'required|integer',
            'percentage' => 'required',
            'Images' => 'required',
            'cities' => 'required|exists:cities,id',
            'products' => 'required|exists:products,id',
            'locale' => 'required',
            'cover_image' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'is_active.required' => 'Status is Required!',
            'subservices_id.required' => 'Status is Required!',
            'services_id.required' => 'Status is Required!',
        ];
    }
}
