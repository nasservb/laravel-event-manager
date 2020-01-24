<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * اطلاعات اضافی یک کاربر بصورت کلید ولیوو در این جدول نگه داری می شود
 *
 * Class UserMeta
 * @package App\Models
 */
class UserMeta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'meta_key',
        'meta_value',
        'extra_data'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
