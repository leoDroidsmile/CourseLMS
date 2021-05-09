<?php

namespace App\Model;

use App\Coupon;
use App\TeacherCoupon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoursePurchaseHistory extends Model
{
    protected $guarded = [];

    public function CouponCode(){
        if(!$this->coupon_id)
            return;

        if(strstr($this->payment_method, "Teacher"))
            return TeacherCoupon::where('id', $this->coupon_id)->first()->code;
        else
            return Coupon::where('id', $this->coupon_id)->first()->code;
    }
}
