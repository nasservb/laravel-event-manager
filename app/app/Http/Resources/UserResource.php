<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends  JsonResource
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
            'name'=>$this->name,
            'family'=>$this->family,
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'avatar_url'=>url('/').'/'.$this->avatar_url,

        ];
    }
}