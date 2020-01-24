<?php

namespace App\Repositories\Sms\Senders;


use App\Repositories\Sms\SmsSenderInterface;

/**
 * send sms by firebase
 * Class FirebaseSmsSender
 * @package App\Repositories\Sms
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
