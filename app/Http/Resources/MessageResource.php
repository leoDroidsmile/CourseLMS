<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'enroll_id'=>$this->enroll_id,
            'user_id'=>$this->user_id,
            'user_type'=>$this->user->user_type,
            'name'=>$this->user->name,
            'email'=>$this->user->email,
            'message'=>$this->content,
            'date'=>date('d-M-y',strtotime($this->created_at)),
        ];
    }
}
