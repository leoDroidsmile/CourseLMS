<?php

namespace App\Http\Resources;

use App\Model\CourseComment;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
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
            'course_id'=>$this->course_id,
            'rating'=>$this->rating,
            'comment'=>$this->comment,
            'created_at'=>date('d-M-y',strtotime($this->created_at)),
            'user'=>new InstructorResourse($this->user),
            'replay'=>ReplayCommentsResource::collection(CourseComment::where('replay',$this->id)->get())
        ];
    }
}


class ReplayCommentsResource extends JsonResource
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
            'course_id'=>$this->course_id,
            'rating'=>$this->rating,
            'comment'=>$this->comment,
            'created_at'=>date('d-M-y',strtotime($this->created_at)),
            'user'=>new InstructorResourse($this->user),
        ];
    }
}
