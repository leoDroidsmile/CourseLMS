<?php

/*all addon route here
 *
 * */


Route::group(['middleware' => ['installed', 'auth', 'activity'], 'prefix' => 'dashboard/coupon'], function () {

    //Coupon
    Route::get('/new', 'CouponController@index')->name('coupon.index');
    Route::get('/coupons', 'CouponController@allCoupons')->name('coupon.all');
    Route::post('/store', 'CouponController@store')->name('coupon.store');
    Route::get('/edit/{id}', 'CouponController@edit')->name('coupon.edit');
    Route::post('/update/{id}', 'CouponController@update')->name('coupon.update');
    Route::post('/activation', 'CouponController@coupon_activation')->name('coupon.activation'); //api ajax

    /**
     * FRONTEND
     */

    Route::post('/coupon', 'CouponController@coupon_store')->name('checkout.coupon.store');
    Route::post('/coupon/destroy', 'CouponController@coupon_destroy')->name('checkout.coupon.destroy');

});


