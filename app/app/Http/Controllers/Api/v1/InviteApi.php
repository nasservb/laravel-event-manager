<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Requests\InviteRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\InviteListResource;
use App\Http\Resources\InviteViewResource;
use App\Http\Resources\SuccessResultResource;
use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Models\User;
use App\Services\Invite\InviteSender;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * فرستادن دعوت نامه برای افراد و شرکت در یک رویداد
 * Class InviteApi
 * @package App\Http\Controllers\Api\v1
 */
class InviteApi extends Controller
{


    /**
     * invite user to event
     * @param Event $event
     * @param InviteRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function invite(Event $event , InviteRequest $request)
    {

        if ($event->user_id != Auth::id())
        {
            return (new ErrorResource([
                'message' => 'Access Denied',
                'code' => 403,]))
                ->response()
                ->setStatusCode(403);
        }

        $input =  $request->all();
        //validation
        if (!isset($input['mobile']) || !isset($input['email']))
        {
            return (new ErrorResource([
                'message' => 'Validation Error',
                'code' => 401,]))
                ->response()
                ->setStatusCode(401);
        }

        $user = null ;
        if (isset($input['email']))
        {
            $user = User::where('email',$request->input('email'))->first();
            if (!$user)
            {
                return (new ErrorResource([
                    'message' => 'User not found ',
                    'code' => 401,]))
                    ->response()
                    ->setStatusCode(401);
            }
        }
        else
        {

            $user = User::where('mobile',$request->input('mobile'))->first();
            if (!$user)
            {
                return (new ErrorResource([
                    'message' => 'User not found ',
                    'code' => 401,]))
                    ->response()
                    ->setStatusCode(401);
            }
        }


        $checkExist = Invite::where([
            ['event_id', $event->id],
            ['sender_user_id',Auth::id()],
            ['receiver_user_id', $user->id]
        ])->first();

        if (!$checkExist)
        {
            return (new ErrorResource([
                'message' => 'Invite already sent',
                'code' => 401,]))
                ->response()
                ->setStatusCode(401);
        }



        $invite =new Invite();
        $invite->sender_user_id = Auth::id();
        $invite->receiver_user_id = $user->id;
        $invite->event_id = $event->id;
        $invite->save();

        app()->make(InviteSender::class)->Send($user , $event);


    }


    /**
     * get my invites
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function inviteList()
    {
        $invites = Invite::where('receiver_user_id', Auth::id())->latest()->paginate();
        return InviteListResource::collection($invites);
    }

    /**
     * view invite and status
     * @param Invite $invite
     * @return \Illuminate\Http\JsonResponse|InviteViewResource
     */
    public  function  view(Invite $invite)
    {
        if ($invite->sender_user_id != Auth::id() && $invite->receiver_user_id != Auth::id() )
        {
            return (new ErrorResource([
                'message' => 'Access Denied',
                'code' => 403,]))
                ->response()
                ->setStatusCode(403);
        }

        return new InviteViewResource($invite);
    }

    /**
     * @param Invite $invite
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|SuccessResultResource
     */
    public function accept(Invite $invite , Request $request)
    {
        if ($invite->receiver_user_id != Auth::id() )
        {
            return (new ErrorResource([
                'message' => 'Access Denied',
                'code' => 403,]))
                ->response()
                ->setStatusCode(403);
        }

        if ($request->input('accept')== 'yes' )
        {
            $invite->is_accept = 'yes' ;
        }
        elseif ($request->input('accept')== 'no' )
        {
            $invite->is_accept = 'no' ;
        }
        else
        {
            $invite->is_accept = 'maybe' ;
        }

        $invite->responded_at=now();
        $invite->save();

        return new SuccessResultResource('OK');

    }


}
