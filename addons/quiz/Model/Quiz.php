<?php

namespace App;

use App\Model\Course;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function questions(){
        return $this->hasMany(Question::class,'quiz_id','id')->where('status',1);
    }

    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
}
