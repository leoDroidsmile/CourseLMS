<?php


    /**
    * FRONTEND
    */

    Route::get('course/redeem/point/{id}', 'WalletController@redeem')->name('course.redeem.point');
    Route::get('points/redeem/history', 'WalletController@history')->name('redeem.points.history');
    Route::post('wallet/payment', 'WalletController@payment')->name('wallet.payment');

    /**
     * BACKEND
     */

Route::group(['middleware' => ['installed', 'auth', 'activity'], 'prefix' => 'dashboard/wallet'], function () {

    Route::get('/', 'WalletController@index')->name('dashboard.wallet');
    Route::post('/wallet/update', 'WalletController@update')->name('wallet.update');

});

/**
 * RECHARGE
 */

 Route::group(['middleware' => ['installed', 'auth', 'activity'], 'prefix' => 'recharge/wallet'], function () {

    Route::get('/{token}/', 'WalletController@recharge')->name('recharge.wallet');
    Route::get('/wallet/get/amount', 'WalletController@getAmount')->name('wallet.amount'); // ajax
    Route::get('/wallet/gateway', 'WalletController@gateway')->name('wallet.gateway');
    Route::post('/wallet/pay/stripe', 'WalletController@stripePay')->name('wallet.stripe');
    Route::post('/wallet/pay/paypal', 'WalletController@payWithpaypal')->name('wallet.paypal');
    
});

Route::post('paytm/wallet/pay', 'WalletController@payWithpaytm')->name('wallet.paytm');
Route::post('paytm/wallet/pay/status', 'WalletController@paymentCallback')->name('wallet.paytm.callback'); // paytm callback