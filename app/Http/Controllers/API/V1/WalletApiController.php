<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alert;
use Carbon\Carbon;
use App\Coupon;
use App\Model\Cart;
use Auth;
use Session;
use App\User;

class WalletApiController extends Controller{
  
    public function charge(Request $request)
    {
      $coupon = Coupon::where('code',$request->code)->Published()->first();
      
      if ($coupon != null) {

        if($coupon->is_used)
            return response(['error' => 'The coupon was already used.'], 200);

        $start_day  = Carbon::create(Coupon::where('code',$request->code)->Published()->first()->start_day);
        $end_day    = Carbon::create(Coupon::where('code',$request->code)->Published()->first()->end_day);
        
        if (Carbon::now() > $start_day && Carbon::now() < $end_day) {
            
            // Add remained amount to user's wallet
            $user = $request->user();
            $amount = $coupon->rate; // (Double) Can be a negative value
            $message = "Charge with Basic Coupon"; //The reason for this transaction

            //Optional (if you modify the point_transaction table)
            $data = [
                'ref_id' => 'someReferId',
            ];

            $transaction = $user->addPoints($amount,$message,$data);

            $coupon->is_used = true;
            $coupon->save();
            
            return response([
                'success' => true,
                'message' => 'Charged successfully.'
                ], 
              200);
        }
        else {
            return response(
              [ 'success' => false,
                'message' => translate('Coupon expired.')
              ], 
            200);
        }
      }else {
        return response(['success'=> false, 'message' => translate('Invalid Coupon Code.')], 200);
      }
    }

    //END
}
