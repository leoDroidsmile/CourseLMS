<?php

/*all addon route here
 *
 * */


Route::group(['middleware' => ['installed', 'auth', 'activity'], 'prefix' => 'dashboard'], function () {

    Route::get('addon/manager', 'AddonController@addons_manager')->name('addons.manager.index');
    Route::get('addon/installation', 'AddonController@installui')->name('addons.manager.installui');
    Route::get('addon/status/{addon}', 'AddonController@addon_status')->name('addon.status');
    Route::post('addon/install', 'AddonController@index')->name('addon.install.index');
    Route::get('addon/preview/{addon}', 'AddonController@addon_preview')->name('addon.preview');
    Route::get('addon/setup/{addon}', 'AddonController@addon_setup')->name('addon.setup');
    Route::post('addons/purchase/code/verify/{addon}', 'AddonController@purchase_code_verify')
        ->name('addons.purchase_code.verify');


    //paytm setup
    Route::post('addon/paytm/account/setup', 'AddonController@paytm_account_setup')->name('addon.paytm.account.setup');

    // Get Index page
    Route::get('addon/index/page', 'AddonController@get_index_page')->name('get.index.page');
    Route::get('addon/install/page', 'AddonController@get_install_page')->name('get.install.page');

});


