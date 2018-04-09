<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    protected $redirectRoute = 'projects.create';

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'         => 'required|string',
            'description'   => 'required|string',
            'hours'         => 'required|integer',
            'date_end'      => 'required|date_format:Y-m-d',
            'status'        => ['required', Rule::in(array_keys(config('enums.projects.statuses')))],
            'type'          => ['required', Rule::in(array_keys(config('enums.projects.types')))],
            'priority'      => ['required', Rule::in(array_keys(config('enums.projects.priorities')))],
        ];
    }
}
