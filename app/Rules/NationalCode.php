<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class NationalCode implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (!validateNationalCode($value)) {
            $fail('فرمت :attribute نامعتبر است');
        }
    }
}
