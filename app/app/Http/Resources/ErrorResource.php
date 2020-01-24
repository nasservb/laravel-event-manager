<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    private $data = [];

    public function __construct($resource)
    {
        $this->data = $resource;

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
            'message' => $this->data['message'],
            'code' => $this->data['code'],
            'status'=>'error'
            ];
    }
}
