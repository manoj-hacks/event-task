<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditEvent extends FormRequest
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
            'id' => 'required|numeric|exists:events,id',
            'title' => 'required|max:256',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'repeat' => 'required|numeric|in:1,2',
            'repeat_type' => 'required_if:repeat,1',
            'repeat_day' => 'required_if:repeat,1',
            'repeat_day_type' => 'required_if:repeat,2',
            'repeat_type_days' => 'required_if:repeat,2',
            'repeat_type_monthly' => 'required_if:repeat,2',

        ];
    }
}
