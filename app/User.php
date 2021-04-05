<?php

namespace App;

use App\Model\VerifyUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Model\Instructor;
use App\Model\Student;
use Mprince\Pointable\Contracts\Pointable;
use Mprince\Pointable\Traits\Pointable as PointableTrait;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasApiTokens;
    use PointableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // relationBetweenInstructor
    function relationBetweenInstructor()
    {
      return $this->hasOne(Instructor::class,'user_id','id');
    }

    // relationBetweenStudent
    function student()
    {
      return $this->hasOne(Student::class, 'user_id', 'id');
    }

    // verifyUser
    public function verifyUser(){
        return $this->hasOne(VerifyUser::class,'user_id','id');
    }

    public function scopeVerify($query){
        return $query->where('verified', true);
    }


      //END



}
