<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IncorrectNewPassword implements Rule
{
    private $currentPassword;

    public function __construct(string $currentPassword)
    {
        $this->currentPassword = $currentPassword;
    }

    public function passes($attribute, $value)
    {
        return $value !== $this->currentPassword;
    }

    public function message()
    {
        return 'New Password cannot be same as your current password. Please choose a different password.';
    }
}
