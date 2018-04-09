<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends FormRequest
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
            'description' => 'string',
            'date_time'   => 'required|date_format:Y-m-d H:i:s',
            'project_id'  => 'required|exists:projects,id',
            'users'       => 'array',
            'users.*'     => 'required|exists:users,id',
        ];
    }
}
