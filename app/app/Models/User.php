<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Spatie\Permission\Traits\HasRoles;

/**
 * مدل کاربر
 * Class User
 * @package App\Models
 */
class User extends Authenticatable  implements MustVerifyEmail
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','family', 'email', 'password','api_token','is_active',
       'avatar_url','mobile','email_verified_at','sms_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function metaValues()
    {
        return $this->hasMany(UserMeta::class);
    }


    public function GetWebsite()
    {
        return static::GetMeta($this->id  , 'website' ) ;
    }


    public static function  addMeta($userId, $key , $value)
    {
        $row = UserMeta::where([
            'user_id'=>$userId,
            'meta_key'=>$key,
        ])->first();

        if ($row)
        {
            $row->Update([
                'meta_value'=>$value
            ]);
        }
        else
        {
            UserMeta::Create([
                'user_id'=>$userId,
                'meta_key'=>$key,
                'meta_value'=>$value
            ]);
        }

    }

    public static function  GetMeta($userId, $key  )
    {
        $row = UserMeta::where([
            'user_id'=>$userId,
            'meta_key'=>$key,
        ])->first();

        if ($row)
            return $row->meta_value;
        else
            return '';
    }

}
