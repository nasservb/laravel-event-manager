<?php


namespace App\Repositories\Sms;

use App\Jobs\SendSms;
use App\Models\Setting;
use App\Repositories\Sms\SmsSenderInterface;
use App\Repositories\Sms\Senders\FirebaseSmsSender;
use App\Repositories\Sms\Senders\KavenegarSmsSender;
use App\Repositories\Sms\Senders\PayamakPanelSmsSender;

/**
 * Handle sms send functionality
 * Class SmsHelper
 * @package App\Helpers
 */
class SmsSender
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
    public function SendSms(String $to , String $message){

        $driver =$this->GetDriver();

        return dispatch(new SendSms($to , $message , $driver))->onQueue('sms');
    }
}
