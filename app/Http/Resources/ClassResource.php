<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassResource extends JsonResource
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
            'title'=>$this->title,
            'priority'=>$this->priority,
            'date'=>date('d-M-y',strtotime($this->created_at)),
            'contents'=>ClassContentResource::collection($this->contents)
        ];
    }
}
