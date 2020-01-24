<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ذخیره اس ام اس های ارسال شده
 * Class Sms
 * @package App\Models
 */
class Sms extends Model
{
    /**
     * fillable values
     * @var array
     */
    protected $fillable = [
                    'message_id',
                    'message',
                    'status',
                    'statustext',
                    'sender',
                    'receptor',
                    'date',
                    'cost',
                    ];
}
