<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{

    // scopeApproved
    public function scopeActive($query)
    {
        return $query->where('activated', 1);
    }

    //END
}
