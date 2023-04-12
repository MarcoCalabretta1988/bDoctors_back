<?php

namespace App\Rules;

use App\Models\Sponsored;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidSponsored implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        if (Sponsored::find($value)) {
            return true;
        } else
            return false;
    }
}
