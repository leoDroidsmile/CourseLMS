<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ClassContent extends Model
{
    use SoftDeletes;

    // relationBetweenClass
   public function relationBetweenClass()
    {
      return $this->belongsTo(Classes::class,'class_id','id');
    }

    // meeting
    public function meeting()
    {
    	return $this->hasOne('App\Meeting','id','meeting_id');
    }

    //END

}
