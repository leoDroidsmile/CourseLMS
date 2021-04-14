<?php
namespace App;
  
use DB;
use TeacherCoupon;
use Maatwebsite\Excel\Concerns\FromCollection;
  
class TeacherCouponExport implements FromCollection
{
    private $coupon_id = '';

    function __construct($coupon_id) {
        $this->coupon_id = $coupon_id;
    }

    public function collection()
    {
        return DB::table('teacher_coupons')
            ->select('teacher_coupons.code', 'users.name as Instructor', "courses.title as Course")
            // ->whereIn('teacher_coupons.id', $this->new_coupon_ids)
            ->where('teacher_coupons.id', $this->coupon_id)
            ->leftJoin('users', 'teacher_coupons.user_id', '=', 'users.id')
            ->leftJoin('courses', 'teacher_coupons.course_id', '=', 'courses.id')
            ->get();
    }
}
