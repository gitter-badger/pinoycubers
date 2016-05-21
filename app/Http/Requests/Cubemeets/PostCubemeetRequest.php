<?php

namespace App\Http\Requests\Cubemeets;

use App\Http\Requests\Request;

class PostCubemeetRequest extends Request
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
            'name' => 'required',
            'location' => 'required',
            'description' => 'required',
            'day' => 'required|date_format:d',
            'month' => 'required|date_format:m',
            'year' => 'required|date_format:Y',
            'start_time' => 'required|date_format:H:i',
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
            'name.required' => 'The name field is required.',
            'location.required' => 'The location field is required.',
            'description.required' => 'The description field is required.',
            'day.required' => 'The day field is required.',
            'month.required' => 'The month field is required.',
            'year.required' => 'The year field is required.',
            'start_time.required' => 'The time field is required.',
            'day.date_format' => 'Invalid day format.',
            'month.date_format' => 'Invalid month format.',
            'year.date_format' => 'Invalid year format.',
            'time.date_format' => 'Invalid time format.'
        ];
    }
}
