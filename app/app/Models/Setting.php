<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * مدل تنظیمات سیستم
 *
 * Class Setting
 * @package App\Models
 */
class Setting extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'title', "key",'value',
        'type'//['number','boolean','string','text','city','province','country','location','color','price_unit','image']
    ];

    /**
     * get value by key
     *
     * @param string $key
     * @return string $value
     */
    public static function  GetValue($key )
    {

        return Cache::store('redis')->rememberForever($key , function ()use($key){

            $value = Setting::where('key',$key)->first() ;
            return (!$value ? '' : $value->value );
        });

    }
}
