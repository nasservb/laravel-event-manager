<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class InviteListResource extends JsonResource
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
            'receiver_name' =>$this->receiverUser->name,
            'receiver_family' =>$this->receiverUser->family,
            'send_status'=>$this->send_status,
        ];
    }

}
