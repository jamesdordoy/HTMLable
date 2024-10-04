<?php

namespace JamesDordoy\HTMLable\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ImportZipRule implements ValidationRule
{
    /**
     * Just check the zip file contents for a html file, a css file, a js file and a folder called img, images or assets. Ill do the website one next time. :D
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}
