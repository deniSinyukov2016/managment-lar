<?php

namespace App\Http\Requests;

use App\Rules\IncorrectNewPassword;
use App\Rules\IncorrectOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'current-password' => ['required', new IncorrectOldPassword()],
            'new-password'     => [
                'required',
                'string',
                'min:6',
                'confirmed',
                new IncorrectNewPassword($this->get('current-password'))]
        ];
    }
}
