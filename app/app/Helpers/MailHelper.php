<?php


namespace App\Helpers;

use App\Jobs\SendMail;

/**
 * Handle sms send functionality
 * Class SmsHelper
 * @package App\Helpers
 */
class MailHelper
{

    /**
     * send message to mail
     * @param String $subject
     * @param String $to
     * @param String $message
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function SendMail(String  $subject , String $to , String $message){

        return dispatch(new SendMail($subject, $to , $message))->onQueue('email');
    }
}
