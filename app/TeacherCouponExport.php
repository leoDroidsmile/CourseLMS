<?php
namespace App;
  
use DB;
use TeacherCoupon;
use Maatwebsite\Excel\Concerns\FromCollection;
  
class TeacherCouponExport implements FromCollection
{
    // private $new_coupon_ids = array();

    // function __construct($coupons) {
    //     $this->new_coupon_ids = $coupons;
    // }

    public function collection()
    {
        return DB::table('teacher_coupons')
            ->select('teacher_coupons.code', 'users.name as Instructor', "courses.title as Course")
            // ->whereIn('teacher_coupons.id', $this->new_coupon_ids)
            ->leftJoin('users', 'teacher_coupons.user_id', '=', 'users.id')
            ->leftJoin('courses', 'teacher_coupons.course_id', '=', 'courses.id')
            ->get();
    }
}
