<?php

namespace App\Http\Resources;

use App\Model\Enrollment;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $total_content = 0;
        $total_duration = 0;
        foreach ($this->classes as $item){
            $total_content += $item->contents->count();
            $total_duration +=$item->contents->sum('duration');
        }
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'slug'=>$this->slug,
            'short_description'=>$this->short_description,
            'big_description'=>$this->big_description,
            'image'=>filePath($this->image),
            'overview_url'=>$this->overview_url,
            'provider'=>$this->provider,
            'requirement'=>json_decode($this->requirement),
            'outcome'=>json_decode($this->outcome),
            'tag'=>json_decode($this->tag),
            'is_free'=>$this->is_free,
            'price'=>$this->price,
            'is_discount'=>$this->is_discount,
            'discount_price'=>$this->discount_price,
            'language'=>$this->language,
            'meta_title'=>json_decode($this->meta_title),
            'meta_description'=>$this->meta_description,
            'category'=> new CategoryResource($this->category),
            'total_enroll'=> Enrollment::where('course_id' , $this->id)->count(),
            'total_class'=>$this->classes->count(),
            'total_content'=>$total_content,
            'total_time'=>$total_duration,
            'instructor'=>new InstructorResourse($this->relationBetweenInstructorUser),
            'created_at'=>date('d-M-y',strtotime($this->created_at)),
            'classes'=>ClassResource::collection($this->classes)

        ];
    }




}
