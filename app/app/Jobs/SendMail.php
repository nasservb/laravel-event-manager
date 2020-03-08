<?php

namespace App\Jobs;

use App\Models\Visit;
use App\Services\Contracts\Sms\SmsSenderInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\TransportManager;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected  $to='';
    protected  $message='';
    protected  $subject='';

    /**
     * SendSms constructor.
     * @param string $subject
     * @param string $to
     * @param string $message
     */
    public function __construct(string $subject,string $to, string $message  )
    {
        //set variables
        $this->subject = $subject;
        $this->to = $to;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Visit::Log(['page'=>'sending_mail_'.$this->subject .'_to_'. $this->to]);

        $content = $this->message;

        $to = $this->to;

        $subject = $this->subject;


        Mail::send([], [], function ($message) use ($subject , $to , $content){
            $message->to($to)
                ->subject($subject)
                // here comes what you want
                ->setBody($content, 'text/html'); // assuming text/plain

        });



    }
}
