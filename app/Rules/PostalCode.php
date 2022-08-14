<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class PostalCode implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail) {
        $value = convertArabicToEnglish($value);
        $value = convertPersianToEnglish($value);
        $pattern = "/\b(?!(\d)\1{3})[13-9]{4}[1346-9][013-9]{5}\b/";
        if (!preg_match($pattern, $value)) {
            $fail('فرمت :attribute نامعتبر است');
        }
    }
}
