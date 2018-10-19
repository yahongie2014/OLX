<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankForm extends FormRequest
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
            'bank_name' => 'required|string',
            'account_number' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'bank_name.required' => 'Bank Required!',
            'account_number.required' => 'Account is required!',

        ];
    }
}
