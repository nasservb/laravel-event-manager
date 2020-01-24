<?php

namespace App\Http\Resources;

use App\Models\Ticket;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'name' =>$this->name,
            'family' =>$this->family,
            'avatar_url'=>url('/').'/'.$this->avatar_url,
            'api_token'=>$this->api_token,
        ];
    }

}
