<?php

namespace App\Rules;

use App\Helpers\Mobile as HelpersMobile;
use Illuminate\Contracts\Validation\Rule;

class Mobile implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $mobile = new HelpersMobile($value);
        return $mobile->isValid();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'شماره موبایل باید یک مقدار صحیح از شماره موبایل‌های اپراتورهای ایرانی باشد.';
    }
}
