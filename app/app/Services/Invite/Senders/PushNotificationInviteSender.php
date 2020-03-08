<?php

namespace App\Services\Invite\Senders;

use App\Models\Invite;
use App\Models\User;
use App\Services\Invite\InviteSenderInterface;

class PushNotificationInviteSender implements InviteSenderInterface{

    public  function send(User $user, Invite $invite)
    {
        // TODO: Implement send() method.
    }
}