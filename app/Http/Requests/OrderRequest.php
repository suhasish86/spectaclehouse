<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'billing_name'    => ['required', 'min:3'],
            'billing_email'   => ['required', 'string', 'email'],
            'billing_phone'   => ['required', 'min:10'],
            'billing_address' => ['required', 'min:3'],
            'billing_pin'     => ['required', 'min:3'],
            'shipping_name'    => ['required', 'min:3'],
            'shipping_email'   => ['required', 'string', 'email'],
            'shipping_phone'   => ['required', 'min:10'],
            'shipping_address' => ['required', 'min:3'],
            'shipping_pin'     => ['required', 'min:3'],
        ];
    }
}
