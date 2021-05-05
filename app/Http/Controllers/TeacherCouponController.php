<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Carbon\Carbon;
use App\TeacherCoupon;
use App\Model\Cart;
use App\Model\Course;
use App\Model\Instructor;
use App\TeacherCouponExport;
use DB;
use Excel;
use Auth;
use Session;

class TeacherCouponController extends Controller
{

    //coupon index
    public function index()
    {
        $teachers = Instructor::all();
        return view('teachercoupon.index', compact('teachers'));
    }

    //coupon index
    public function allCoupons(Request $request)
    {
      if ($request->get('search')) {
        $coupons = TeacherCoupon::where('code', $request->get('search'))->get();
        
        if(sizeof($coupons) == 0)
          $coupons = TeacherCoupon::where('id', $request->get('search'))->get();
      } else {
        $coupons = TeacherCoupon::latest()->get();
      }

      return view('teachercoupon.list', compact('coupons')); 
    }

    //store coupons
    public function store(Request $request)
    {
        // Generate random coupon code with 13 digits
        for($i = 0 ; $i < $request->vouchers; $i++){
          $coupon = new TeacherCoupon();

          $coupon->code = mt_rand(1,9) . mt_rand(0,9) . mt_rand(0,9) . mt_rand(0,9) . mt_rand(0,9). mt_rand(0,9). mt_rand(0,9). mt_rand(0,9). mt_rand(0,9). mt_rand(0,9). mt_rand(0,9). mt_rand(0,9). mt_rand(0,9);
          if ($request->is_published == 'on') {
              $coupon->is_published = true;
          } else {
              $coupon->is_published = false;
          }
          $coupon->group      = $request->group_name;  
          $coupon->user_id    = $request->user_id;
          $coupon->course_id  = $request->course_id;  
          $coupon->is_used    = false;  
          $coupon->student_id = null;  
          $coupon->save();
        }

        Alert::success(translate('Done'), translate('Teacher Coupon Created Successfully'));
        return back();
    }

    //coupon edit
    public function edit($id)
    {
        $single_coupon = TeacherCoupon::findOrFail($id);
        $teachers = Instructor::all();
        $courses = Course::where('user_id', $single_coupon->user_id)->get();

        return view('teachercoupon.edit', compact('single_coupon', 'teachers', 'courses'));
    }

    // coupon_activation
    public function coupon_activation(Request $request)
    {
        $coupon_activation = Coupon::where('id', $request->id)->first();

        if ($coupon_activation->is_published == 0) {
            $coupon_activation->is_published = 1;
            $coupon_activation->save();
        } else {
            $coupon_activation->is_published = 0;
            $coupon_activation->save();
        }

        return response(['message' => 'Status changed'], 200);
    }

    //coupon update
    public function update(Request $request, $id)
    {
        $coupon_update = TeacherCoupon::findOrFail($id);
        $coupon_update->code = $request->code;
        
        if ($request->is_published == 'on') {
            $coupon_update->is_published = true;
        } else {
            $coupon_update->is_published = false;
        }

        $coupon_update->user_id    = $request->user_id;
        $coupon_update->course_id  = $request->course_id;

        $coupon_update->save();
        Alert::success(translate('Done'), translate('Coupon Updated Successfully'));
        return back();
    }


    // Coupon Delete
    public function delete(Request $request, $id){
      $coupon = TeacherCoupon::findOrFail($id);
      $coupon->delete();
      Alert::success(translate('Done'), translate('Coupon Deleted Successfully'));
      return back();
    }


    public function deleteAll(Request $request){
      TeacherCoupon::truncate();
      Alert::success(translate('Done'), translate('All Teacher Coupons Deleted Successfully'));
      return back();
    }

    /**
     * FRONTEND
     */

    public function coupon_store(Request $request)
    {
      $coupon = Coupon::where('code',$request->code)->Published()->select('code')->first();

      if ($coupon != null) {
          $start_day  = Carbon::create(Coupon::where('code',$request->code)->Published()->first()->start_day);
          $end_day    = Carbon::create(Coupon::where('code',$request->code)->Published()->first()->end_day);
          $min_value  = Coupon::where('code',$request->code)->Published()->first()->min_value;

         if (Carbon::now() > $start_day && Carbon::now() < $end_day) {
           if ($min_value <= $request->total) {
             session()->put('coupon',[
               'name' => $coupon->code,
               'discount' => $coupon->discount($coupon->rate),
               'total' => $request->total,
             ]);
              Session::flash('success', translate('Coupon applied'));
              return back();
           }else {
            Session::flash('error', 'Minimum Amount '. ' ' . $min_value . ' '  .'needed');
             return back();
           }
        }
        else {
            Session::flash('error',translate('Coupon expired.'));
          return back();
        }
      }else {
        Session::flash('error' ,translate('Invalid Coupon Code.'));
        return back();
      }
    }


    /**
     * COUPON DESTROY
     */

    public function coupon_destroy(Request $request)
    {
      session()->forget(['coupon']);
      Session::flash('error' ,translate('Coupon removed'));
      return back();
    }

      
    public function downloadTeacherCoupons(Request $request){
      return Excel::download(new TeacherCouponExport($request->id), 'teachercoupons.xls');
    }
  
    //END
}
