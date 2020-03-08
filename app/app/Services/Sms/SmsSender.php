<?php


namespace App\Services\Sms;

use App\Jobs\SendSms;
use App\Models\Setting;
use App\Services\Sms\SmsSenderInterface;
use App\Services\Sms\Senders\FirebaseSmsSender;
use App\Services\Sms\Senders\KavenegarSmsSender;
use App\Services\Sms\Senders\PayamakPanelSmsSender;

/**
 * Handle sms send functionality
 * Class SmsHelper
 * @package App\Helpers
 */
class SmsSender implements SmsSenderInterface
{

    private   $driver = null;

    /**
     * get active sms sender driver
     * @return SmsSenderInterface
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public   function GetDriver(): SmsSenderInterface
    {
        if ($this->driver != null)
            return  $this->driver;


        switch (Setting::GetValue('sms_default_driver') )
        {
            case  'payamak-panel' :
                $this->driver= app()->make(PayamakPanelSmsSender::class);
                break;
            case 'firebase':
                $this->driver= app()->make(FirebaseSmsSender::class);
                break;
            default : //or kavenegar
                $this->driver= app()->make(KavenegarSmsSender::class);
                break;
        }

        return $this->driver;
    }

    /**
     * send message to phoneNumber
     * @param String $to
     * @param String $message
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function SendSms(String $to , String $message):bool{

        $driver =$this->GetDriver();

        return dispatch(new SendSms($to , $message , $driver))->onQueue('sms');
    }
}
