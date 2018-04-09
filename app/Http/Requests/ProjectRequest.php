<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
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
            'title'       => 'nullable',
            'description' => 'nullable',
            'hours'         => 'required|integer',
            'date_end'      => 'required|date_format:Y-m-d',
            'status'        => ['required', Rule::in(array_keys(config('enums.projects.statuses')))],
            'type'          => ['required', Rule::in(array_keys(config('enums.projects.types')))],
            'priority'      => ['required', Rule::in(array_keys(config('enums.projects.priorities')))],
        ];
    }
}
