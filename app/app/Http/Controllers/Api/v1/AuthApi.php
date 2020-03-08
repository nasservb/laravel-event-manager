<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterMobileOauthRequest;
use App\Http\Requests\RegisterOauthRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\SendSmsToMobileRequest;
use App\Http\Requests\VerifySmsRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\SuccessResultResource;
use App\Mail\WelcomeSellerMail;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserMeta;
use App\Services\Sms\SmsSender;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Kavenegar\KavenegarApi as KavenegarApi;

/**
 * توابع موبایل مربوط به لاگین و ثبت نام
 * Class AuthApi
 * @package App\Http\Controllers\Api\v1
 */
class AuthApi extends Controller
{
    use ResetsPasswords;

    /**
     * @param LoginRequest $request
     * @return LoginResource|\Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {



        if (
            Auth::attempt(
            [
                'mobile' => $request->input('user_name'),
                'password' => $request->input('password')
            ])
            ||

            Auth::attempt(
                [
                    'email' => $request->input('user_name'),
                    'password' => $request->input('password')
                ])
        ) {
            $token = mb_strtolower(bin2hex(openssl_random_pseudo_bytes(64)));

            $user = Auth::user();

            $user->update([
                'api_token' => $token,
            ]);


            //@todo check user if businessman or admin , don't allow to login

            if ($request->input('device_id')!=  '' ){
                User::addMeta($user->id,'device_id_'.time(),$request->input('device_id') );
            }

            return new LoginResource($user );

        } else {

            return (new ErrorResource([
                'message' => 'Authentication Error',
                'code' => 401,]))
                ->response()
                ->setStatusCode(401);



        }

    }

    /**
     * @deprecated
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse|LoginResource
     */
    public function register(RegisterRequest $request)
    {

        $token = mb_strtolower(bin2hex(openssl_random_pseudo_bytes(64)));

        $user = User::create([
            'name' => $request->input('name'),
            'family' => $request->input('family'),
            'mobile' =>$request->input('mobile'),
            'email' =>$request->input('email') ,
            'password' => Hash::make($request->input('password')),
            'api_token' => $token,
        ]);

        User::addMeta($user->id,'device_id',$request->input('device_id'));

        User::addMeta($user->id,'verify_by','mobile' );

        return new LoginResource( $user) ;

    }



    /**
     * send sms to iranian mobile on register by mobile
     *
     * @param SendSmsToMobileRequest $request
     * @return \Illuminate\Http\JsonResponse|SuccessResultResource
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function sendSmsToMobile(SendSmsToMobileRequest $request)
    {

        $existUser = User::where('mobile',$request->input('mobile') )
            ->orWhere('email',$request->input('email'))
            ->first();

        if ($existUser )
        {
            return (new ErrorResource([
                'message' => 'User already exist',
                'code' => 422,]))
                ->response()
                ->setStatusCode(422);

        }

        $user = User::create([
            'name' => ' ',
            'mobile' => $request->input('mobile'),
            'email' =>$request->input('email'),
            'password' => $request->input('password'),
            'api_token' =>  '',
        ]);

        $confirmation_code = rand(100000,9999999);

        User::addMeta($user->id,'device_id',$request->input('device_id'));

        User::addMeta($user->id,'country_code',$request->input('country_code') );

        User::addMeta($user->id,'country_name',$request->input('country_name') );

        User::addMeta($user->id , 'email' ,$request->input('email') );

        User::addMeta($user->id , 'mobile' ,$request->input('mobile') );

        User::addMeta($user->id,'verify_by','sms' );

        User::addMeta($user->id,'oauth_driver','mobile' );

        User::addMeta($user->id,'sms_code',$confirmation_code);

        //call sms sender to send sms



        app()->make(SmsSender::class)->SendSms(
                            $request->input('mobile'),
                            $confirmation_code);

        return new SuccessResultResource('OK');

    }

    /**
     * verify sms for iranian users after register
     * @param VerifySmsRequest $request
     * @return LoginResource|\Illuminate\Http\JsonResponse
     */
    public function verifySms(VerifySmsRequest $request)
    {
        $user = User::where('mobile',$request->input('mobile'))->first();

        $verify =User::GetMeta($user->id, 'sms_code');


        $count = UserMeta::where('user_id', $user->id )->where('meta_key' ,"   like '%try_verifySms_%' "  )->count();

        if ($count > 7 )
        {

            Log::emergency('try to login , mobile:'.$request->input('mobile') . ',code: '.$request->input('code') );
            return (new ErrorResource([
                'message' => 'Blocked for so many try ',
                'code' => 400,]))
                ->response()
                ->setStatusCode(400);


        }


        if ($verify != $request->input('code'))
        {
            User::addMeta($user->id,'try_verifySms_'. $request->input('code') ,'mobile' );

            Log::emergency('try to login , mobile:'.$request->input('mobile') . ',code: '.$request->input('code') );

            return (new ErrorResource([
                'message' => 'Code is not valid',
                'code' => 400,]))
                ->response()
                ->setStatusCode(400);
        }

        //remove code
        User::addMeta($user->id, 'confirmed_mobile',$request->input('mobile'));

        $token = mb_strtolower(bin2hex(openssl_random_pseudo_bytes(64)));
        $user->api_token = $token;
        $user->password = Hash::make($user->password );
        $user->save();

        return  new LoginResource( $user ) ;

    }

    /**
     * forget password
     * @param ForgetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse|SuccessResultResource
     */
    public function forget(ForgetPasswordRequest $request)
    {

        $existUser = User::where('email',$request->input('email'))->first();

        if ($existUser )
        {
            $response =$this->broker()->sendResetLink(
                $this->credentials($request)
            );

            if ( $response == Password::RESET_LINK_SENT)
            {

                User::addMeta($existUser->id,'verify_email_code_in',time());

                return new SuccessResultResource('OK');
            }
            else
            {
                //failed send condition
                return (new ErrorResource([
                    'message' => 'could not send an email , please try it later',
                    'code' => 422,]))
                    ->response()
                    ->setStatusCode(422);

            }
        }
        else
        {
            return (new ErrorResource([
                'message' => 'Email not found in user accounts',
                'code' => 422,]))
                ->response()
                ->setStatusCode(422);

        }



    }


}
