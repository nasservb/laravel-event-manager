<?php


namespace App\Repositories\Sms;

/**
 * for integrate all sms functionality
 * Interface SmsSenderInterface
 * @package App\Repositories\Contracts\Sms
 */
interface SmsSenderInterface
{
    /**
     * send message to phone number
     * @param $to
     * @param $message
     * @return bool
     */
    public function SendSms($to,$message):bool ;


}
