<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'course_price'=>$this->course_price,
            'date'=>date('d-M-y',strtotime($this->created_at)),
            'course'=>new CourseResource($this->course)
        ];
    }
}
