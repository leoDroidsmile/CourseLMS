<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    //
    public function scopeActive($query){
        return $query->where('active', true);
    }
}
