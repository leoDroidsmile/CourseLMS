<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{

    use SoftDeletes;

    public function scopePublished($query){
        return  $query->where('is_published', 1);
    }
}
