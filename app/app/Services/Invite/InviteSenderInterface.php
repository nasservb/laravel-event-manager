<?php

namespace App\Services\Invite;
use App\Models\Invite;
use App\Models\User;

/**
 * Interface InviteSenderInterface for send invite
 * @package App\Services\Contracts\Invite
 */
interface  InviteSenderInterface{

    /**
     * send invite for user
     * @param User $user
     * @param Invite $invite
     * @return mixed
     */
    public function send(User $user,Invite $invite);

}
