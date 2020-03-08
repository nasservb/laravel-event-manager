<?php

namespace App\Jobs;

use App\Models\Invite;
use App\Models\User;
use App\Services\Invite\InviteSenderInterface;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendInvite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user =null;
    private $invite=null;
    private $driver =null;

    /**
     *
     * SendInvite constructor.
     * @param User $user
     * @param Invite $invite
     * @param InviteSenderInterface $driver
     */
    public function __construct(User $user , Invite $invite , InviteSenderInterface $driver)
    {
        $this->user = $user;
        $this->invite= $invite;
        $this->driver= $driver;
    }

    /**
     * send invite to user
     *
     * @return void
     */
    public function handle()
    {
        try{
            $this->driver->send($this->user, $this->invite);
            $this->invite->send_status='sent';
        }
        catch (\Exception $e)
        {
            $this->invite->send_status='failed';
        }

        $this->invite->save();
    }
}
