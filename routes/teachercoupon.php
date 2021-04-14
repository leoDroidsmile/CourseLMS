<?php

/*all addon route here
 *
 * */


Route::group(['middleware' => ['installed', 'auth', 'activity'], 'prefix' => 'dashboard/teachercoupon'], function () {

    //Coupon
    Route::get('/new', 'TeacherCouponController@index')->name('teachercoupon.index');
    Route::get('/coupons', 'TeacherCouponController@allCoupons')->name('teachercoupon.all');
    Route::post('/store', 'TeacherCouponController@store')->name('teachercoupon.store');
    Route::get('/edit/{id}', 'TeacherCouponController@edit')->name('teachercoupon.edit');
    Route::post('/update/{id}', 'TeacherCouponController@update')->name('teachercoupon.update');
    Route::post('/activation', 'TeacherCouponController@coupon_activation')->name('teachercoupon.activation'); //api ajax
    Route::get('/download/{id}', 'TeacherCouponController@downloadTeacherCoupons')->name('teachercoupon.download'); 

    /**
     * FRONTEND
     */

    Route::post('/coupon', 'TeacherCouponController@coupon_store')->name('checkout.teachercoupon.store');
    Route::post('/coupon/destroy', 'TeacherCouponController@coupon_destroy')->name('checkout.teachercoupon.destroy');

});


