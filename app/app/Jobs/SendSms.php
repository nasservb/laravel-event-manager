<?php

namespace App\Jobs;

use App\Repositories\Sms\SmsSenderInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected  $to='';
    protected  $message='';
    protected  $driver=null;

    /**
     * SendSms constructor.
     * @param string $to
     * @param string $message
     * @param SmsSenderInterface $driver
     */
    public function __construct(string $to, string $message , SmsSenderInterface $driver )
    {
        //set variables
        $this->to = $to;
        $this->message = $message;
        $this->driver = $driver ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->driver->SendSms($this->to, $this->message);
    }
}
