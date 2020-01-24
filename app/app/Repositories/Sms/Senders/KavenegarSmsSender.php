<?php


namespace App\Repositories\Sms\Senders;


use App\Models\Sms;
use App\Repositories\Sms\SmsSenderInterface;

use Illuminate\Support\Facades\Log;

use Kavenegar\Exceptions\ApiException;

/**
 * send sms by Payamak Panel
 * Class PayamakPanelSmsSender
 * @package App\Repositories\Sms
 */
class KavenegarSmsSender implements  SmsSenderInterface
{


    /**
     * verify mobile by code
     * @param $mobile
     * @param $code
     * @return bool
     */
    public function Verify($mobile, $code): bool
    {

        try
        {
            $receptor =  $mobile ;

            $token = $code;

            $template = 'activesms';


            $result = app('kavenegar')->VerifyLookup(
                                                            $receptor,
                                                            $token,
                                                            '' /*$token2*/,
                                                            ''/*$token3*/,
                                                            $template,
                                                            $type = null) ;


            if($result){
                $r= $result[0] ;
                $sms = new Sms();

                $sms->message_id= $r->messageid   ;
                $sms->message=   $r->message ;
                $sms->status=    $r->status;
                $sms->statustext=  $r->statustext  ;
                $sms->sender=    $r->sender;
                $sms->receptor=   $r->receptor ;
                $sms->date=    $r->date;
                $sms->cost=    $r->cost;
                $sms->save();

                return  true ;
            }
            else {
                Log::critical($result);
                return false;
            }


        }
        catch(ApiException $e){
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            Log::critical($e->errorMessage());

            return  false ;

        }
        catch(HttpException $e){
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            Log::critical($e->errorMessage());

            return  false;
        }


    }

    /**
     * send message to phone number
     * @param $to
     * @param $message
     * @return bool
     */
    public function SendSms($to, $message): bool
    {

        /**
         * call verify when message is just number
         */
        if (intval($message)> 0 )
        {
            return  $this->Verify($to, $message);
        }


        try{

            $sender = env('SMS_NUMBER');
            $receptor = array( $to );
            $result = app('kavenegar')->Send($sender,$receptor,$message);



            if($result){
                foreach($result as $r){
                    $sms = new Sms();

                    $sms->message_id= $r->messageid   ;
                    $sms->message=   $r->message ;
                    $sms->status=    $r->status;
                    $sms->statustext=  $r->statustext  ;
                    $sms->sender=    $r->sender;
                    $sms->receptor=   $r->receptor ;
                    $sms->date=    $r->date;
                    $sms->cost=    $r->cost;
                    $sms->save();

                }
            }

        }
        catch(ApiException $e){
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            Log::critical($e->errorMessage());

            return  false ;

        }
        catch(HttpException $e){
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            Log::critical($e->errorMessage());

            return  false;
        }

        /*
        sample output:
        {
            "return":
            {
                "status":200,
                "message":"تایید شد"
            },
            "entries":
            [
                {
                    "messageid":8792343,
                    "message":"خدمات پیام کوتاه کاوه نگار",
                    "status":1,
                    "statustext":"در صف ارسال",
                    "sender":"10004346",
                    "receptor":"09123456789",
                    "date":1356619709,
                    "cost":120
                },
                {
                    "messageid":8792344,
                    "message":"خدمات پیام کوتاه کاوه نگار",
                    "status":1,
                    "statustext":"در صف ارسال",
                    "sender":"10004346",
                    "receptor":"09367891011",
                    "date":1356619709,
                    "cost":120
                }
            ]
        }
        */

    }
}
