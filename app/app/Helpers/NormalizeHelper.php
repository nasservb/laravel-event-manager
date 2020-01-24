<?php


namespace App\Helpers;

use App\Models\User;

/**
 * Normalize repository class
 * handle all validation normalizer
 * Class NormalizeRepo
 * @package App\Helpers
 */
class NormalizeHelper
{

    /**
     * @param $mobile
     * @return string
     */
    public static function InternationalMobile($mobile)
    {
        if (substr($mobile,0,3)== '+98')
            return  $mobile;

        if (substr($mobile,0,4)== '0098')
            return  $mobile;

        if (substr($mobile,0,2)== '09')
            $mobile = substr($mobile,1);

        return '+98'. $mobile;
    }

    /**
     * get user formal name
     * @param User $user
     * @return string
     */
    public  static function  GetFormalUserTitle(User $user):string
    {
        if ($user->name == '' && $user->family !='' )
        {
            return  $user->family. ' عزیز ' ;
        }
        elseif ($user->name != '' && $user->family =='' )
        {
            return  $user->name. ' عزیز ' ;
        }
        else if($user->name != '' && $user->family !='')
        {
            return  $user->name.' ' .  $user->family. ' عزیز ' ;
        }

        return 'کاربر گرامی' ;

    }


}
