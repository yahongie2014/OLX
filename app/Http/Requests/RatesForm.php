<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatesForm extends FormRequest
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
            'ads_id' => 'required|integer',
            'average' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'average.required' => 'average Required!',
            'ads_id.required' => 'Ads Required!',
            'ads_id.integer' => 'Ads must be integer!',

        ];
    }
}
