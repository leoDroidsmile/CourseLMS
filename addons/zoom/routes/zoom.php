<?php
// ZOOM

Route::group(['middleware' => ['installed', 'checkBackend', 'auth'], 'prefix' => 'dashboard'], function () {
    Route::get('zoom/board','ZoomController@dashboard')->name('zoom.index');
    Route::get('zoom/setting','ZoomController@setting')->name('zoom.setting');
    Route::post('zoom/token/update','ZoomController@updateToken')->name('updateToken');
    Route::get('zoom/create/meeting','ZoomController@create')->name('meeting.create');
    Route::get('zoom/edit/meeting/{meetingid}','ZoomController@edit')->name('zoom.edit');
    Route::get('zoom/show/meeting/{meetingid}','ZoomController@show')->name('zoom.show');
    Route::delete('zoom/delete/meeting/{id}','ZoomController@delete')->name('zoom.delete');
    Route::post('zoom/store/new/meeting','ZoomController@store')->name('zoom.store');
    Route::post('zoom/update/meeting/{meetingid}','ZoomController@updatemeeting')->name('zoom.update');
    
    Route::post('zoom/get/enrolled/student/','ZoomController@get_enrolled_student')->name('get.enrolled.student'); //ajax call
});