<?php


namespace App\Repositories\Invite;

use App\Jobs\SendInvite;
use App\Models\Invite;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\Invite\InviteSenderInterface;
use App\Repositories\Invite\Senders\EmailInviteSender;
use App\Repositories\Invite\Senders\PushNotificationInviteSender;
use App\Repositories\Invite\Senders\SmsInviteSender;

/**
 * Handle Invite send functionality
 * Class InviteHelper
 * @package App\Repositories\Invite
 */
class InviteSender
{

    private   $driver = null;

    /**
     * get active sms sender driver
     * @return InviteSenderInterface
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public   function GetDriver(): InviteSenderInterface
    {
        if ($this->driver != null)
            return  $this->driver;

        switch (Setting::GetValue('invite_default_driver'))
        {
            case 'sms':
                $this->driver= app()->make(SmsInviteSender::class);
                break;
            case 'push':
                $this->driver= app()->make(PushNotificationInviteSender::class);
                break;
            default : //or email
                $this->driver= app()->make(EmailInviteSender::class);
                break;
        }

        return $this->driver;
    }

    /**
     * send invite to user
     * @param User $user
     * @param Invite $invite
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function SendInvite(User $user, Invite $invite){

        $driver =$this->GetDriver();

        return dispatch(new SendInvite($user , $invite , $driver))->onQueue('invite');
    }
}
