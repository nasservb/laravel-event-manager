<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $this->company_name=User::GetMeta($this->id , 'company_name' );
        $this->website=User::GetMeta($this->id , 'website' );

        return [
            'id' =>$this->id,
            'name' =>$this->name  ,
            'family' =>$this->family  ,
            'company_name'=>($this->GetCompanyName()?? '' ),
            'mobile'=>($this->mobile ?? '' ),
            'website'=>($this->GetWebsite() ?? '' ),
            'email'=>($this->email ?? ''),
            'avatar_url'=> ($this->avatar_url == '' ? asset('assets/images/icon/man.png') : url('/').'/'.$this->avatar_url),
        ];
    }
}
