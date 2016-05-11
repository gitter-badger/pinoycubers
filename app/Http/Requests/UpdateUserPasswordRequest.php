<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateUserPasswordRequest extends Request
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
            'currentpass' => 'required',
            'newpass' => 'required|confirmed|min:8'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'currentpass.required' => 'The current password is required',
            'newpass.required' => 'The new password is required',
            'newpass.confirmed' => 'Password confirmation does not match'
        ];
    }
}
