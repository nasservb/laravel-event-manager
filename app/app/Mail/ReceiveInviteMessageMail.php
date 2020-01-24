<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * شما یک پیام جدید دارید
 * Class ReceiveMessageMail
 * @package App\Mail
 */
class ReceiveInviteMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @data to send in mail view
     */
    protected $data;


    /**
     * Create a new message instance.
     * WelcomeSellerMail constructor.
     * @param $data
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.receive-invite-message')
            ->with($this->data);
    }
}
