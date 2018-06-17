<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'bail|required|unique:users|email|max:100',
            'password' => 'required|min:6|max:100',
            'email' => 'confirmed:email_confirmation',
            'password' => 'confirmed:password_confirmation',
        ];
    }
}
