<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'id'=>$this->user_id,
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'address'=>$this->address,
            'about'=>$this->about,
            'image'=>filePath($this->image),
            'fb'=>$this->fb,
            'linked'=>$this->tw,
            'join date'=>date('d-M-Y',strtotime($this->created_at))

        ];
    }
}
