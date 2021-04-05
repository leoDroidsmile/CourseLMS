<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    
    protected $fillable = ['meeting_id', 'owner_id', 'start_time', 'zoom_url', 'user_id', 'meeting_title' , 'course_id', 'link_by', 'type', 'agenda'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function courses()
    {
    	return $this->belongsTo('App\Model\Course','course_id','id');
    }

    


    //END
}
