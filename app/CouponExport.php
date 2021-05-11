<?php
namespace App;
  
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
  
class CouponExport implements FromCollection
{
    private $coupon_id = '';

    function __construct($coupon_id) {
        $this->coupon_id = $coupon_id;
    }

    public function collection()
    {
        $coupon = Coupon::findOrFail($this->coupon_id);
        return DB::table('coupons')
            ->select('id', 'code')
            ->where('group', $coupon->group)
            ->get();
    }
}
