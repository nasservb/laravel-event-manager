<?php

namespace App\Repositories\Invite\Senders;

use App\Helpers\NormalizeHelper;
use App\Models\Invite;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\Invite\InviteSenderInterface;
use App\Repositories\Sms\SmsSender;

/**
 * send invite by sms
 * Class SmsInviteSender
 * @package App\Repositories\Invite
 */
class SmsInviteSender implements  InviteSenderInterface {

    public function send(User $user, Invite $invite)
    {
        //@todo implement $invite->getShortLink() to generate short link

        $message =NormalizeHelper::GetFormalUserTitle($user) . "\n".
          "شما به رویداد ".$invite->title.
        " دعوت شده اید!\n"
         ."جهت ثبت نام و اعلام حضور به\n".Setting::GetValue('invite_landing_url').'/'.$invite->id.'/1'. //1=>sms,2=>email,...
        "\nمراجعه نمائید.";
        $to =NormalizeHelper::InternationalMobile($user->mobile);

        App()->make(SmsSender::class)->SendSms($to ,$message );

    }
}
