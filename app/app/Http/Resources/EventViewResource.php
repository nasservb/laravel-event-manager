<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class EventViewResource extends  JsonResource
{

    private  $event= null ;

    public function __construct($resource)
    {
        $this->event = $resource ;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public  function toArray($request)
    {
        $status = $this->event->getStatus();

        return [
            'id'=>$this->event->id,
            'name' =>$this->event->name,
            'description' =>$this->event->description,
            'yse_response_count'=>$status['yesResponseInvite'],
            'no_response_count'=>$status['noResponseInvite'],
            'maybe_response_count'=>$status['maybeResponseInvite'],
            'invites'=>InviteListResource::collection($this->event->invites)
        ];
    }




}