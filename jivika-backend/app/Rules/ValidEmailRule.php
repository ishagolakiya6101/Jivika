<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidEmailRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Use PHP's built-in email validation filter
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function message()
    {
        return 'The :attribute must be a valid email address.';
    }
}
