<?php
// PAYTM
Route::post('paytm/payment', 'PaytmController@eventOrderGen')->name('paytm.payment'); //paytm.payment;
Route::post('paytm/payment/status', 'PaytmController@paymentCallback')->name('paytm.callback'); // paytm callback