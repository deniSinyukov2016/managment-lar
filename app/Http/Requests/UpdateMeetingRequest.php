<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeetingRequest extends FormRequest
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
            'name'        => 'required|string',
            'description' => 'required|string',
            'date_time'   => 'required|date_format:Y-m-d H:i:s',
            'users'       => 'required|array',
            'users.*'     => 'required|exists:users,id',
            'is_close'    => 'boolean',
            'results'     => 'nullable|string'
        ];
    }
}
