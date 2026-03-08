<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;

class Captcha implements Rule
{

    public function __construct()
    {
        //
    }

    /**
     * @param  $attribute
     * @param  $value
     * @return mixed
     */
    public function passes($attribute, $value)
    {
        $recaptchaSetting = googleRecaptchaObject();
        $recaptcha        = new ReCaptcha($recaptchaSetting->secret_key);
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
        return __('Please complete the recaptcha to submit the form');
    }
}
