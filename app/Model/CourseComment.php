<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CourseComment extends Model
{
    public function replay()
    {
        return $this->hasMany(CourseComment::class, 'replay', 'id')
            ->with('user');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'name', 'email', 'image');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id')->select('id', 'title', 'slug');
    }

//this is only for comment index
    public function replayLast()
    {
        return $this->hasMany(CourseComment::class, 'replay', 'id')->latest();
    }
}
