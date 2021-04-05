<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstructorSubscriptionEarning extends Model
{

    /*Check deactive*/
    public function course()
    {
        return $this->hasOne('App\Model\Course','id','course_id');
    }

    //END
}
