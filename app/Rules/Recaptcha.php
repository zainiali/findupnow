<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha as NewRecap;

class Recaptcha implements Rule
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
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function passes($attribute, $value)
    {
        $recaptchaSetting = googleRecaptchaObject();
        $recaptcha        = new NewRecap($recaptchaSetting->secret_key);
        $response         = $recaptcha->verify($value, $_SERVER['REMOTE_ADDR']);
        return $response->isSuccess();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please complete the recaptcha to submit the form';
    }
}
