<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackagePurchaseHistory extends Model
{

    use SoftDeletes;

    /*Relation with package*/
    public function package(){
        return $this->belongsTo(Package::class,'package_id','id');
    }
}
