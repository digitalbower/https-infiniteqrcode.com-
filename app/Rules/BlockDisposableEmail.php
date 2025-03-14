<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BlockDisposableEmail implements ValidationRule
{

    protected array $disposableDomains;

    public function __construct()
    {
        $this->disposableDomains = config('disposable.domains', []);
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $domain = substr(strrchr($value, "@"), 1);

        if (in_array($domain, $this->disposableDomains)) {
            $fail('Disposable email addresses are not allowed.');
        }
    }
}
