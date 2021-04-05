<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }
    
    //END
}
