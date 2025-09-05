<?php

namespace App\Http\Requests\API;

use App\Models\User;

class LoginUserAPIRequest extends BaseAPIRequest
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
            'email' => ['required_without:phone', 'string', 'email', 'exists:users,email'],
            'password' => ['required_without:otp'],
            // 'phone' => ['required_without:email', 'phone:IN', 'exists:users,phone'],
            'otp' => ['required_without:password'],
            // 'device_token' => ['nullable','string']
        ];
    }
}
