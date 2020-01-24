<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'title', "user_id",'description','date',

    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function invites()
    {
        return $this->hasMany(Invite::class , 'event_id','id');
    }

    public function getStatus()
    {

        $yesResponseInvite =$this->invites->filter(function ($row){
            return ($row->is_accept=='yes');
        }) ;
        $noResponseInvite =$this->invites->filter(function ($row){
            return ($row->is_accept=='no');
        }) ;
        $maybeResponseInvite =$this->invites->filter(function ($row){
            return ($row->is_accept=='maybe');
        }) ;

        return [
            'yesResponseInvite'=>$yesResponseInvite,
            'noResponseInvite'=>$noResponseInvite,
            'maybeResponseInvite'=>$maybeResponseInvite,
        ];
    }




}
