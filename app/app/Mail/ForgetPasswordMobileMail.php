<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * ایمیل فراموشی رمز عبور
 * send email in forget password
 *
 * Class ForgetPasswordMobileMail
 * @package App\Mail
 */
class ForgetPasswordMobileMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @data to send in mail view
     */
    protected $data;

    /**
     * Create a new message instance.
     * send mail in forget password
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

        return $this->view('email.forget-password-mobile');
    }

}
