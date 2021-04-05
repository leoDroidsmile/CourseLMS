<?php

namespace App\Http\Resources;

use App\Model\Course;
use App\Model\SeenContent;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{



    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $seen_content = SeenContent::where('user_id',$this->user_id)->where('enroll_id',$this->id)->get()->count();
        $course = Course::where('id',$this->course_id)->with('classes')->first();
        $total_content = 0;
        foreach ($course->classes as $item){
          $total_content += $item->contents->count();
        }
        // calculate the % done this enroll course
        $percentage = ($seen_content / $total_content) * 100;

        return [
            'id'=>$this->id,
            'amount'=>$this->history->amount,
            'method'=>$this->history->payment_method,
            'date'=>date('d-M-y',strtotime($this->created_at)),
            'percentage'=>$percentage,
            'message'=>MessageResource::collection($this->messages),
            'course'=>new EnrollCourseResource($this->enrollCourse)
        ];
    }
}
