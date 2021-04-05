<?php

namespace App;

use App\Model\Category;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
