<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    protected $guarded = ['id'];
    
    public function scopePublished($query){
        return  $query->where('is_published', 1);
    }

    public function findMyCode($code)
    {
      return self::where('code',$code)->first();
    }

    public function discount($total)
    {
      return $this->rate;
    }

    public function student(){
      if($this->student_id)
        return User::findOrFail($this->student_id);
    }
    
    //END
}
