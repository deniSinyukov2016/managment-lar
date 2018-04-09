<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IncorrectOldPassword implements Rule
{
    public function passes($attribute, $value)
    {
        return \Hash::check($value, auth()->user()->password);
    }

    public function message()
    {
        return 'Your current password does not matches with the password. Please try again.';
    }
}
