<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Biblys\Isbn\Isbn as IsbnValidator;

class Isbn implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return IsbnValidator::isParsable($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute field value does not match any of the ISBN standards';
    }
}
