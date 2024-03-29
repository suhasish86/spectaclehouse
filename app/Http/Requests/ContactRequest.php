<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'contact_name'    => ['required', 'min:3'],
            'contact_email'   => ['required', 'string', 'email'],
            'contact_phone'   => ['required', 'min:10'],
            'contact_message' => ['required', 'min:3'],
        ];
    }
}
