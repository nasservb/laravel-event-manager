<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResultResource extends JsonResource
{
    private $message = '';
    public  function  __construct($message)
    {
        $this->message = $message;
        parent::__construct(new \stdClass());
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'message'=>$this->message
        ];
    }
}
