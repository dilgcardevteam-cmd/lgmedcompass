<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{
    public function passes($attribute, $value)
    {
        $value = trim($value);

        return preg_match(
            '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/',
            $value
        );
    }

    public function message()
    {
        return 'Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.';
    }
}
