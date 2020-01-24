<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'sender_user_id',
        "receiver_user_id",
        'send_status',//'sending','sent','failed'
        'is_accept',//'no-response','yes','no','maybe'
        'is_read',
        'responded_at',
        'event_id'
    ];


    public function senderUser()
    {
        return $this->belongsTo(User::class,'sender_user_id');
    }



    public function receiverUser()
    {
        return $this->belongsTo(User::class,'receiver_user_id');
    }


    public function event()
    {
        return $this->belongsTo(Event::class,'event_id');
    }



}
