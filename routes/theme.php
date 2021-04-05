<?php

Route::group(['middleware' => ['installed', 'auth', 'activity'], 'prefix' => 'dashboard'], function () {

    Route::get('theme/manager', 'ThemeController@theme_manager')->name('theme.manager.index');
    Route::get('theme/installation', 'ThemeController@installui')->name('theme.manager.installui');
    Route::get('theme/status/{theme}', 'ThemeController@theme_status')->name('theme.status');
    Route::post('theme/install', 'ThemeController@index')->name('theme.install.index');
    Route::get('theme/preview/{theme}', 'ThemeController@theme_preview')->name('theme.preview');
    Route::post('theme/purchase/code/verify/{theme}', 'ThemeController@purchase_code_verify')
        ->name('theme.purchase_code.verify');

    Route::get('theme/index/page','ThemeController@get_index_page')->name('theme.get.index.page');
    Route::get('theme/install/page','ThemeController@get_install_page')->name('theme.get.install.page');

});
