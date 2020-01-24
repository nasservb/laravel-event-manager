<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Requests\CreateEventRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventViewResource;
use App\Http\Resources\SuccessResultResource;
use App\Models\Event;
use App\Http\Controllers\Controller;
use Dompdf\Exception;
use Illuminate\Support\Facades\Auth;


/**
 * ساخت و مدیریت رویداد
 * Class EventApi
 * @package App\Http\Controllers\Api\v1
 */
class EventApi extends Controller
{

    /**
     * create new event
     * @param CreateEventRequest $request
     * @return SuccessResultResource
     */
    public function create(CreateEventRequest $request)
    {

        $event = new Event();
        $event->title = $request->title ;
        $event->description = $request->description ;

        try {
            $event->date =$request->date;
        }
        catch (\Exception $e )
        {

        }
        $event->user_id = Auth::id() ;
        $event->save();


        return new SuccessResultResource('OK');
    }

    /**
     * get list of event created by current user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public  function index()
    {
        $events = Event::where('user_id',Auth::id())->paginate( );

        return EventResource::collection($events);
    }

    /**
     * return event info
     * @param Event $event
     * @return EventViewResource|\Illuminate\Http\JsonResponse
     */
    public function view (Event $event)
    {
        if ($event->user_id != Auth::id())
        {
            return (new ErrorResource([
                'message' => 'Access Denied',
                'code' => 403,]))
                ->response()
                ->setStatusCode(403);
        }

        return new EventViewResource($event);
    }




}
