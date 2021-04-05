<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstructorSubscriptionPayment extends Model
{

     use SoftDeletes;
     
    public function subscription()
    {
        
        return $this->hasOne('App\Subscription','name','subscription_duration');
    }

    //END
}
