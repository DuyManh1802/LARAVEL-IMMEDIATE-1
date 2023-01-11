<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users|email|max:100',
            'password' => 'required|min:8|string|max:255|confirmed',
            'address' => 'required|string|max:255',
            'phone' => 'required|regex:/(0)[0-9]{0,15}/'
        ];
    }
}
