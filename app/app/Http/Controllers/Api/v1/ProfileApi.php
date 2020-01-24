<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\SuccessResultResource;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * توابع موبایل مربوط به تغییر رمز عبور و پروفایل
 * Class ProfileApi
 * @package App\Http\Controllers\Api\v1
 */
class ProfileApi extends Controller
{
    /**
     * @return ProfileResource
     */
    public function show()
    {
        return new ProfileResource(\Illuminate\Support\Facades\Auth::user());
    }

    /**
     * @param ProfileRequest $request
     * @return SuccessResultResource
     */
    public function update(ProfileRequest $request)
    {

        Log::error(json_encode($request));

		$user = User::find(Auth::id() );
		$user->name = $request->input('name');
        $user->family=$request->input('family');
        $user->save();

        $destinationPath = public_path('/files/user/');

        if ($request->hasFile('avatar')) {

            try
            {

                if(! file_exists($destinationPath))
                    mkdir($destinationPath,'0775',true);

                $image = $request->file('avatar');

                $pictureUrl ='avatar_'. time().'.jpg';
                $image->move($destinationPath, $pictureUrl);


                $img = Image::make($destinationPath.'/'.$pictureUrl);
                $img->response('jpg');
                $img->save($destinationPath.'/'.$pictureUrl);

                $user->avatar_url = 'files/user/'.$pictureUrl;

                $user->save();

            }
            catch (\Exception $e )
            {
            }
        }

        User::addMeta($user->id , 'company_name' ,$request->input('company_name') );
        User::addMeta($user->id , 'website' ,$request->input('website') );
        User::addMeta($user->id , 'last_update_profile' ,now());

        return new SuccessResultResource( 'OK' );
    }
}
