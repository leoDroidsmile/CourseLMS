<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionCourse extends Model
{
    protected $fillable = ['course_id', 'subscription_duration'];

    protected $casts = [
        'subscription_duration' => 'array',
    ];

    /*Check popular*/
    public function scopeNotPublished($query)
    {
        return $query->where('is_published', 0);
    }

    /*Check deactive*/
    public function course()
    {
        return $this->hasOne('App\Model\Course','id','course_id');
    }

    /*Check deactive*/
    public function payment()
    {
        return $this->hasMany('App\InstructorSubscriptionPayment','course_id','course_id');
    }

}
