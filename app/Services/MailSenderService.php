<?php

namespace App\Services;

use App\Helpers\MailHelper;
use App\Models\User;
use App\Traits\GlobalMailTrait;
use Exception;
use Illuminate\Support\Facades\Log;

class MailSenderService
{
    use GlobalMailTrait;

    public function __construct()
    {
        MailHelper::setMailConfig();
    }

    public function sendVerifyMailToAllUser()
    {
        try {
            $users = User::where('email_verified_at', null)->orderBy('id', 'desc')->get();
            foreach ($users as $user) {
                $user->verification_token = \Illuminate\Support\Str::random(100);
                $user->save();

                [$subject, $message] = $this->fetchEmailTemplate('user_verification', ['user_name' => $user->name]);

                $link    = [__('CONFIRM YOUR EMAIL') => route('user-verification', $user->verify_token)];
                $message = str_replace('{{user_name}}', $user->name, $message);

                $this->sendMail($user->email, $subject, $message, $link);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param $email_list
     * @param $mail_subject
     * @param $mail_message
     */
    public function sendBulkEmail($userList, $mailSubject, $mailMessage)
    {
        try {
            foreach ($userList as $email) {
                $this->sendMail($email->email, $mailSubject, $mailMessage);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param $user
     */
    public function afterRegistrationMail($user, $name)
    {
        try {
            [$subject, $message] = $this->fetchEmailTemplate('User Verification', ['user_name' => $name]);
            $link                = [__('CONFIRM YOUR EMAIL') => route('user-verification', $user->otp_mail_verify_token)];

            $this->sendMail($user->email, $subject, $message, $link);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * @param $user
     */
    public function afterRegistrationOTPMail($user, $name)
    {
        try {
            [$subject, $message] = $this->fetchEmailTemplate('User Verification', ['user_name' => $name]);
            $link                = [];
            $message .= "\n\n" . __('Your OTP is:') . ' ' . $user->verify_token;

            $this->sendMail($user->email, $subject, $message, $link);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
