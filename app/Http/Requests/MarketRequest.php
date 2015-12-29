<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MarketRequest extends Request
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
            'title' => 'requred',
            'description' => 'required',
            'contact' => 'requred',
            'type' => 'required',
            'manufacturer' => 'requred',
            'condition' => 'required',
            'container' => 'required',
            'shipping' => 'required',
            'meetups' => 'required'
        ];
    }

    /**
     * Set custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'The title field is required.'
            'description.required' => 'The description field is required',
            'contact.required' => 'The contact number field is required',
            'type.required' => 'The type field is required',
            'manufacturer.required' => 'The manufacturer field is required',
            'condition.required' => 'The condition field is required',
            'container.required' => 'The container field is required',
            'shipping.required' => 'The shipping field is required',
            'meetups.required' => 'The meetups field is requiredd'
        ];
    }
}
