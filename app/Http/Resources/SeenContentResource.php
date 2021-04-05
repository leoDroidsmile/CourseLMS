<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeenContentResource extends JsonResource
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
            'course'=>$this->course_id,
            'class'=>$this->class_id,
            'content'=>$this->content_id,
            'enroll'=>$this->enroll_id,
            'user'=>$this->user_id,
            'seen'=>true,
        ];
    }
}
