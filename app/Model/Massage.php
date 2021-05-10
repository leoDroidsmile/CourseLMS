<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Massage extends Model
{


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function sender(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function receiver(){
        return $this->belongsTo(User::class,'enroll_id','id');
    }
}
