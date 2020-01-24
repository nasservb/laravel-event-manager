<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class InviteViewResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'sender_user' =>new UserResource($this->senderUser),
            'receiver_user' =>new UserResource($this->receiverUser),
            'send_status' =>$this->send_status,
            'is_accept' =>$this->is_accept,
            'responded_at' =>jdate($this->responded_at)->format('Y-m-d H:i:s'),
            'event'=> new EventResource($this->event),
        ];
    }

}
