<?php

namespace App;

use App\Model\Course;
use Illuminate\Database\Eloquent\Model;

class TeacherCoupon extends Model
{

    protected $guarded = ['id'];
    
    public function scopePublished($query){
        return  $query->where('is_published', 1);
    }

    public function findMyCode($code)
    {
      return self::where('code',$code)->first();
    }

    public function discount($total)
    {
      return $this->rate;
    }
    
    public function instructorName(){
      return User::findOrFail($this->user_id);
    }

    public function student(){
      if($this->is_used && $this->student_id)
        return User::findOrFail($this->student_id);
    }

    public function courseTitle(){
      return Course::findOrFail($this->course_id);
    }

    public function course(){
      return $this->belongsTo(Course::class, 'course_id', 'id')->with('category');
    }

    //END
}
