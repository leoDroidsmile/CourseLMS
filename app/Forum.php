<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $guarded = ['id'];

    // username
    public function username()
    {
        return $this->hasOne('App\User','id','user_id');
    }


    // category
    public function categoryName()
    {
        return $this->hasOne('App\Model\Category','id','category');
    }
    //END
}
