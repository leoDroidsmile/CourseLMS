<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\EnrollmentResource;
use App\Http\Resources\WishlistResource;
use App\Model\Cart;
use App\Model\CoursePurchaseHistory;
use App\Model\Enrollment;
use App\Model\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WishlistApiController extends Controller
{
    /* login Student save here wishlist
     * Wishlist store */
    public function wishlistStore(Request $request)
    {
        $rules = [
            'studentId' => 'required',
            'courseId' => 'required'
        ];

        $customMessages = [
            'studentId.required' => 'The Student  is required .',
            'courseId.required' => 'The Course  is required.',

        ];

        $validator = Validator::make($request->all(), $rules,$customMessages);
        /*IF the validators fail*/
        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }
        $wishlist = new Wishlist();
        $wishlist->user_id = $request->studentId;
        $wishlist->course_id = $request->courseId;
        $wishlist->course_price = $request->coursePrice;
        $wishlist->save();
        $wishlist = Wishlist::with('course')->where('user_id',  $wishlist->user_id)->get();
        return WishlistResource::collection($wishlist)->additional(['success' => true, 'status' => 200]);
    }


    /*
     * Remove Wishlist from database*/
    public function deleteWishlist($id)
    {
        Wishlist::destroy($id);
        return response(['message' => 'Wishlist Deleted Successfully'], 200);
    }

    /*Show All WishList*/
    public function allWishlist($id)
    {
        $wishlist = Wishlist::with('course')->where('user_id', $id)->get();
        return WishlistResource::collection($wishlist)->additional(['success' => true, 'status' => 200]);
    }


    /*Add to cart*/
    public function addCart(Request $request)
    {
        $rules = [
            'studentId' => 'required',
            'courseId' => 'required'
        ];
        $customMessages = [
            'studentId.required' => 'The Student   is required .',
            'courseId.required' => 'The Course  is required.',

        ];

        $validator = Validator::make($request->all(), $rules,$customMessages);
        /*IF the validators fail*/
        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }
        $cart = new Cart();
        $cart->user_id = $request->studentId;
        $cart->course_id = $request->courseId;
        $cart->course_price = $request->coursePrice;
        $cart->save();
        $cart = Cart::with('course')->where('user_id', $cart->user_id)->get();
        return CartResource::collection($cart)->additional(['success' => true, 'status' => 200]);
    }

    /*all student card*/
    public function allCart($id)
    {
        $cart = Cart::with('course')->where('user_id', $id)->get();
        return CartResource::collection($cart)->additional(['success' => true, 'status' => 200]);
    }

    /*remove the cart*/
    public function removeCart($id){
        Cart::where('id', $id)->delete();
        return response(['message' => 'Delete Cart success'], 200);
    }

    //END
}
