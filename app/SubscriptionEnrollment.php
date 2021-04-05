<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionEnrollment extends Model
{

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    //END
}
