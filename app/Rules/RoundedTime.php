<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RoundedTime implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $minute = (int) explode(':', $value)[1];

        if ($minute % 30 !== 0) {
            $fail('The :attribute must be in 30-minute intervals.');
        }
    }
}
