<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionCourseRequest extends Model
{

    public function course()
    {
        return $this->hasOne('App\Model\Course','id','course_id');
    }
    
    //END
}
