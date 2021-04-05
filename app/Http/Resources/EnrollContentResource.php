<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EnrollContentResource extends JsonResource
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
            'title'=>$this->title ,
            'content_type'=>$this->content_type ,
            'provider'=>$this->provider ,
            'video_url'=>$this->video_url ,
            'file'=>filePath($this->file),
            'description'=>$this->description,
            'priority'=>$this->priority,
            'source_code'=>filePath($this->source_code),
            'date'=>date('d-M-y',strtotime($this->created_at)),
        ];
    }
}
