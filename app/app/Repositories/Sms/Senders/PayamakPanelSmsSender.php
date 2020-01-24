<?php


namespace App\Repositories\Sms\Senders;


use App\Repositories\Sms\SmsSenderInterface;

/**
 * send sms by Payamak Panel
 * Class PayamakPanelSmsSender
 * @package App\Repositories\Sms
 */
class PayamakPanelSmsSender implements  SmsSenderInterface
{

    /**
     * send sms by payamak-panel api
     * @param $to
     * @param $message
     * @return bool
     * @throws \SoapFault
     */
    public function SendSms($to, $message): bool
    {

        ini_set("soap.wsdl_cache_enabled", "0");

        $sms_client = new \SoapClient(
            'http://api.payamak-panel.com/post/send.asmx?wsdl',
            array('encoding'=>'UTF-8'));

        $parameters['username'] = env('SMS_USERNAME');
        $parameters['password'] = env('SMS_PASSWORD');
        $parameters['to'] = $to ; //"912...";
        $parameters['from'] = env('SMS_NUMBER');;
        $parameters['text'] =$message;
        $parameters['isflash'] =false;


        return $sms_client->SendSimpleSMS2($parameters)->SendSimpleSMS2Result;

    }
}
