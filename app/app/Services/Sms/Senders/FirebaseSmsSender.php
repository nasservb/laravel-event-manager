<?php

namespace App\Services\Sms\Senders;


use App\Services\Sms\SmsSenderInterface;

/**
 * send sms by firebase
 * Class FirebaseSmsSender
 * @package App\Services\Sms
 */
class FirebaseSmsSender implements SmsSenderInterface
{
    /**
     * @param $to
     * @param $message
     * @return bool
     */
    public  function SendSms($to, $message): bool
    {
        // TODO: Implement SensSms() method.
    }

}
