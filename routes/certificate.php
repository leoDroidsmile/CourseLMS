<?php

use App\CertificateStore;

Route::group(['middleware'=>['installed','auth'],'prefix'=>'dashboard'],function (){
    Route::get('certificate/setup','CertificateController@create')->name('certificate.setup');
    Route::post('certificate/text/save','CertificateController@textSave')->name('template.text');
    Route::get('certificate/demo','CertificateController@demoCertificate')->name('demo.certificate');


});

/*frontend */
Route::get('certificate/{id}','CertificateController@getCertificate')->name('certificate.get')->middleware('auth');
Route::get('certificate/show/{uid}/{id}','CertificateController@certificateShow')->name('certificate.show');

Route::get('certificate/download/{id}',function ($id){
    $cStore = CertificateStore::where('id', $id)->first();
    $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
    $path =public_path($cStore->image);
    $customPaper = array(0,0,816,700);
    $html = '<img src="'.$path.'" width="100%" style="margin-top:40px">';
    $pdf->loadHTML($html)->setPaper($customPaper, 'portrait')->setWarnings(false)->save('certificate.pdf');
    return $pdf->stream();
})->name('image.download');
