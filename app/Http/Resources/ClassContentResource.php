<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ClassContentResource extends JsonResource
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
            'id'=>$this->id ,
            'title'=>$this->title,
            'provider'=>$this->provider ,
            'description'=>$this->description,
            'priority'=>$this->priority,
            'date'=>date('d-M-y',strtotime($this->created_at)),
        ];
    }
}
