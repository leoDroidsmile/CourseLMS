<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{

//    use SoftDeletes;

    public function enrollCourse()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id')
            ->with('relationBetweenInstructorUser')
            ->with('category')
            ->with('enrollClasses');
    }

    public function history()
    {
        return $this->hasOne(CoursePurchaseHistory::class, 'enrollment_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::Class, 'user_id', 'user_id');
    }

    /*Message*/
    public function messages()
    {
        return $this->hasMany(Massage::class, 'enroll_id', 'id')->with('user');
    }

    public function messagesForInbox()
    {
        return $this->hasOne(Massage::class, 'enroll_id', 'id')
            ->latest()->with('user');
    }

    public function user()
    {
        return $this->belongsTo(User::Class, 'user_id', 'id');
    }

    public function course()
    {
        return $this->hasOne(Course::Class, 'id', 'course_id');
    }

    public function student_email()
    {
        return $this->hasOne(User::Class, 'id', 'user_id');
    }
}
