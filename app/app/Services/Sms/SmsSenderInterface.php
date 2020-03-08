<?php


namespace App\Services\Sms;

/**
 * for integrate all sms functionality
 * Interface SmsSenderInterface
 * @package App\Services\Contracts\Sms
 */
interface SmsSenderInterface
{
    /**
     * send message to phone number
     * @param $to
     * @param $message
     * @return bool
     */
    public function SendSms(String $to,String $message):bool ;


}
