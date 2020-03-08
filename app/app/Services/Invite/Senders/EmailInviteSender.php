<?php


namespace App\Services\Invite\Senders;


use App\Jobs\SendMail;
use App\Mail\ReceiveInviteMessageMail;
use App\Models\Invite;
use App\Models\User;
use App\Services\Invite\InviteSenderInterface;

/**
 * Class EmailInviteSender
 * @package App\Services\Invite
 */
class EmailInviteSender implements InviteSenderInterface
{

    /**
     * @param User $user
     * @param Invite $invite
     * @return mixed|void
     */
    public function send(User $user, Invite $invite)
    {
        $subject='دعوتنامه رویداد '.$invite->event->title;

        $sender = $invite->event->user;

        $template_data = [
            'sender_name'=>$sender->name .' '. $sender->family,
            'event_name'=>$invite->event->title,
            'event_name_created_at'=>$invite->event->date,
            'iosUrl'=>Setting::GetValue('ios_appstore_url'),
            'androidUrl'=>Setting::GetValue('android_appstore_url'),
        ];

        $message = (new ReceiveInviteMessageMail($template_data) )->render() ;

        dispatch(new SendMail($subject , $user->email , $message));
    }
}