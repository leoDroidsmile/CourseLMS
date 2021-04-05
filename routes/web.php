<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'install.check', 'prefix' => 'install'], function () {
    Route::get('/', 'InstallerController@welcome')->name('install');
    Route::get('server/permission', 'InstallerController@permission')->name('permission');
    Route::get('database/create', 'InstallerController@create')->name('create');
    Route::get('database/check', 'InstallerController@checkDbConnection')->name('check.db');
    Route::post('setup/database', 'InstallerController@dbStore')->name('db.setup');
    Route::get('setup/import/sql', 'InstallerController@importSql')->name('sql.setup');
    Route::get('setup/instructor/create', 'InstallerController@importDemoSql')->name('sql.demo.setup'); // upload demo data
    Route::post('setup/instructor/setup', 'InstallerController@instructorStore')->name('setup.instructor'); // insert the instructor
    Route::get('setup/org/create', 'InstallerController@orgCreate')->name('org.create');
    Route::post('setup/org/store', 'InstallerController@orgSetup')->name('org.setup');
    Route::get('setup/admin', 'InstallerController@adminCreate')->name('admin.create');
    Route::post('setup/admin/store', 'InstallerController@adminStore')->name('admin.store');
});


Route::group(['middleware' => 'installed'], function () {
    //all user login
    Auth::routes(['register' => false]);
    //app routes
    Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
    Route::get('/callback/{provider}', 'SocialController@callback');

    Route::get('user/verify/{token}', 'Auth\RegisterController@verifyUser')->name('user.verify');
    Route::post('send/verify/code', 'Auth\RegisterController@sendToken')->name('send.verify.token');
    Route::get('verify/user', 'Auth\RegisterController@verifyForm');
});

Route::group(['middleware' => ['installed', 'checkBackend', 'auth', 'activity'], 'prefix' => 'dashboard'], function () {

    Route::get('/mark-as-read/{id}', 'Module\UserNotificationController@mark_as_read')->name('mark_as_read');
    Route::get('/mark-as-all-read', 'Module\UserNotificationController@mark_as_all_read')->name('mark_all_read');
    Route::get('/notifications/{user}', 'Module\UserNotificationController@see_all_notifications')->name('see_all_notifications');
    Route::get('post-sortable', 'Course\ContentController@update')->name('content.short');

    Route::get('/home', 'Dashboard\DashboardController@index')->name('dashboard');

    //course
    Route::get('course/create', 'Course\CourseController@create')->name('course.create');
    Route::post('course/store', 'Course\CourseController@store')->name('course.store')->middleware('demo');
    Route::get('course/index', 'Course\CourseController@index')->name('course.index');
    Route::get('course/index/{course_id}/{slug}', 'Course\CourseController@show')->name('course.show');
    Route::get('course/edit/{course_id}/{slug}', 'Course\CourseController@edit')->name('course.edit');
    Route::post('course/update', 'Course\CourseController@update')->name('course.update')->middleware('demo');
    Route::get('course/trash/{course_id}/{slug}', 'Course\CourseController@destroy')->name('course.destroy');
    Route::get('course/published', 'Course\CourseController@published')->name('course.publish');
    Route::get('course/rating', 'Course\CourseController@rating')->name('course.rating');

    // class
    Route::get('class/create/{id}', 'Course\ClassController@create')->name('classes.create');
    Route::post('class/store', 'Course\ClassController@store')->name('classes.store')->middleware('demo');
    Route::get('class/edit/{id}', 'Course\ClassController@edit')->name('classes.edit');
    Route::post('class/update', 'Course\ClassController@update')->name('classes.update')->middleware('demo');
    Route::get('class/trash/{id}', 'Course\ClassController@destroy')->name('classes.destroy');
    //class content
    Route::get('class/content/create/{id}', 'Course\ContentController@create')->name('classes.contents.create');
    Route::post('class/content/store', 'Course\ContentController@store')->name('classes.contents.store')->middleware('demo');
    Route::get('class/content/trash/{id}', 'Course\ContentController@destroy')->name('classes.contents.destroy');
    Route::get('class/content/show/{id}', 'Course\ContentController@show')->name('classes.contents.show');
    Route::get('class/content/source/code/{id}', 'Course\ContentController@code')->name('classes.contents.code');
    Route::post('course/slug/check', 'Course\CourseController@check')->name('slug.check')->middleware('demo');
    Route::get('content/published', 'Course\ContentController@published')->name('class.content.published');
    Route::get('content/preview', 'Course\ContentController@preview')->name('class.content.preview');


    //Instructor Earning
    Route::get('instructor/earning', 'Module\EarningController@instructorEarning')->name('instructor.earning');

    //all payment
    Route::get('payment/request', 'Module\PaymentController@paymentRequest')->name('payments.request');

    //instructor
    Route::get('instructor/index', 'Instructor\InstructorController@index')->name('instructors.index');
    Route::get('instructor/show/{id}', 'Instructor\InstructorController@show')->name('instructors.show');
    Route::get('/profile/{id}', 'Instructor\InstructorController@edit')->name('instructors.edit');
    Route::post('/profile/update', 'Instructor\InstructorController@update')->name('instructors.update')->middleware('demo');
    Route::post('/users/banned', 'Instructor\InstructorController@banned')->name('users.banned')->middleware('demo');

    //messages with student
    Route::get('message/inbox', 'Module\MessageController@index')->name('messages.index');
    Route::get('message/show/{id}', 'Module\MessageController@show')->name('messages.show');
    Route::post('message/send', 'Module\MessageController@send')->name('messages.replay')->middleware('demo');
    Route::get('comments/index', 'Module\MessageController@allCommenting')->name('comments.index');
    Route::get('comments/show/{id}', 'Module\MessageController@commentShow')->name('comments.show');
    Route::get('comments/delete/{id}', 'Module\MessageController@commentDestroy')->name('comments.delete');
    Route::post('comments/replay', 'Module\MessageController@commentReplay')->name('comments.replay')->middleware('demo');

    //account setup
    Route::get('account/setup', 'Module\PaymentController@accountSetup')->name('account.create');
    Route::post('account/update', 'Module\PaymentController@accountUpdate')->name('account.update')->middleware('demo');
    Route::get('account/details/{id}/{userId}/{method}/{payId}', 'Module\PaymentController@accountDetails')
        ->name('account.details');


    //Todo:there are the user Manager section
    Route::get('user/destroy/{id}', 'UserManager\UserController@destroy')->name('users.destroy');
    Route::get('user/create', 'UserManager\UserController@create')->name('users.create');
    Route::post('user/store', 'UserManager\UserController@store')->name('users.store')->middleware('demo');
    Route::get('user/edit/{id}', 'UserManager\UserController@edit')->name('users.edit');
    Route::post('user/update', 'UserManager\UserController@update')->name('users.update')->middleware('demo');
    Route::get('user/show/{id}', 'UserManager\UserController@show')->name('users.show');
    Route::get('user/index', 'UserManager\UserController@index')->name('users.index');


    /**
     * MEDIA MANAGER
     */

    Route::get('media/manager', 'MediaManagerController@index')->name('media.index');
    Route::post('media/index', 'MediaManagerController@main')->name('media.main')->middleware('demo');
    Route::get('media/manager/create', 'MediaManagerController@create')->name('media.create');
    Route::post('media/manager/store', 'MediaManagerController@store')->name('media.store')->middleware('demo');
    Route::get('media/manager/show', 'MediaManagerController@show')->name('media.show');
    Route::get('media/manager/edit/{id}', 'MediaManagerController@edit')->name('media.edit');
    Route::post('media/manager/update/{id}', 'MediaManagerController@update')->name('media.update')->middleware('demo');
    Route::post('media/manager/slide', 'MediaManagerController@slide')->name('media.slide')->middleware('demo');
    Route::post('media/manager/filter/{type}', 'MediaManagerController@filter')->name('media.filter')->middleware('demo');
    Route::get('media/manager/trash/{item}', 'MediaManagerController@destroy')->name('media.delete');


    Route::get('email', 'Dashboard\DashboardController@template');

    //SMTP Setting
    Route::get('smtp/create', 'Setting\SettingController@smtpCreate')->name('smtp.create');
    Route::post('smtp/store', 'Setting\SettingController@smtpStore')->name('smtp.store')->middleware('demo');

    //site setting
    Route::get('site/setting', 'Setting\SettingController@siteSetting')->name('site.setting');
    Route::post('site/setting/update', 'Setting\SettingController@siteSettingUpdate')->name('site.update')->middleware('demo');

    //app site setting
    Route::get('app/setting', 'Setting\SettingController@appSetting')->name('app.setting');
    Route::post('app/setting/update', 'Setting\SettingController@appSettingUpdate')->name('app.update')->middleware('demo');

    /*other settings here*/
    Route::get('other/settings','Setting\SettingController@otherSetting')->name('other.setting');
    Route::post('other/setting','Setting\SettingController@otherSettingUpdate')->name('other.update');

    //Language Setting
    Route::get('language/index', 'Setting\LanguageController@index')
        ->name('language.index');
    Route::post('language/store', 'Setting\LanguageController@store')
        ->name('language.store')->middleware('demo');
    Route::get('language/destroy/{id}', 'Setting\LanguageController@destroy')
        ->name('language.destroy');
    Route::get('language/translate/{id}', 'Setting\LanguageController@translate_create')
        ->name('language.translate');
    Route::post('language/translate/store', 'Setting\LanguageController@translate_store')
        ->name('language.translate.store')->middleware('demo');
    Route::post('language/change', 'Setting\LanguageController@changeLanguage')
        ->name('language.change')->middleware('demo');
    Route::get('language/default/{id}', 'Setting\LanguageController@defaultLanguage')
        ->name('language.default');

    //Currency Setting
    Route::get('currency/index', 'Setting\CurrencyController@index')->name('currencies.index');
    Route::get('currency/create', 'Setting\CurrencyController@create')->name('currencies.create');
    Route::post('currency/store', 'Setting\CurrencyController@store')->name('currencies.store')->middleware('demo');
    Route::get('currency/delete/{id}', 'Setting\CurrencyController@destroy')->name('currencies.destroy');
    Route::get('currency/edit/{id}', 'Setting\CurrencyController@edit')->name('currencies.edit');
    Route::post('currency/update', 'Setting\CurrencyController@update')->name('currencies.update')->middleware('demo');
    Route::post('currency/default', 'Setting\CurrencyController@default')->name('currencies.default')->middleware('demo');
    Route::get('currency/published', 'Setting\CurrencyController@published')->name('currencies.published');
    Route::get('currency/align', 'Setting\CurrencyController@alignment')->name('currencies.align');
    Route::post('currency/change', 'Setting\CurrencyController@change')->name('currencies.change')->middleware('demo');

    //support
    Route::get('ticket/index', 'Module\SupportTicketController@index')->name('tickets.index');
    Route::get('ticket/create', 'Module\SupportTicketController@create')->name('tickets.create');
    Route::post('ticket/store', 'Module\SupportTicketController@store')->name('tickets.store')->middleware('demo');
    Route::get('ticket/show/{id}', 'Module\SupportTicketController@show')->name('tickets.show');
    Route::post('ticket/replay', 'Module\SupportTicketController@replay')->name('tickets.replay')->middleware('demo');

    //payment
    Route::get('payments/index', 'Module\PaymentController@index')->name('payments.index');
    Route::get('payments/create', 'Module\PaymentController@create')->name('payments.create');
    Route::post('payments/store', 'Module\PaymentController@store')->name('payments.store')->middleware('demo');
    Route::get('payments/destroy/{id}', 'Module\PaymentController@destroy')->name('payments.destroy');
    Route::get('payments/status/{id}', 'Module\PaymentController@status')->name('payments.status');

    //Category
    Route::get('category/create', 'Module\CategoryController@create')->name('categories.create');
    Route::post('category/store', 'Module\CategoryController@store')->name('categories.store')->middleware('demo');
    Route::get('category/edit/{id}', 'Module\CategoryController@edit')->name('categories.edit');
    Route::post('category/update', 'Module\CategoryController@update')->name('categories.update')->middleware('demo');
    Route::get('category/destroy/{id}', 'Module\CategoryController@destroy')->name('categories.destroy');
    Route::get('category/index', 'Module\CategoryController@index')->name('categories.index');

    //this route for published or unpublished
    Route::get('category/published', 'Module\CategoryController@published')->name('categories.published');
    Route::get('category/popular', 'Module\CategoryController@popular')->name('categories.popular');
    Route::get('category/top', 'Module\CategoryController@top')->name('categories.top');

    //package
    Route::get('packages/index', 'Module\PackageController@index')->name('packages.index');
    Route::get('packages/create', 'Module\PackageController@create')->name('packages.create');
    Route::get('packages/edit/{id}', 'Module\PackageController@edit')->name('packages.edit');
    Route::get('packages/destroy/{id}', 'Module\PackageController@destroy')->name('packages.destroy');
    Route::post('packages/store', 'Module\PackageController@store')->name('packages.store')->middleware('demo');
    Route::post('packages/update', 'Module\PackageController@update')->name('packages.update')->middleware('demo');

    //slider
    Route::get('slider/index', 'Module\SliderController@index')->name('sliders.index');
    Route::get('slider/create', 'Module\SliderController@create')->name('sliders.create');
    Route::post('slider/store', 'Module\SliderController@store')->name('sliders.store')->middleware('demo');
    Route::get('slider/destroy/{id}', 'Module\SliderController@destroy')->name('sliders.destroy');
    Route::get('slider/edit/{id}', 'Module\SliderController@edit')->name('sliders.edit');
    Route::post('slider/update', 'Module\SliderController@update')->name('sliders.update')->middleware('demo');
    Route::get('slider/published', 'Module\SliderController@published')->name('sliders.published');

    //Earning
    Route::get('admin/earning', 'Module\EarningController@adminEarning')->name('admin.earning.index');

    //student
    Route::get('student/index', 'Module\StudentController@index')->name('students.index');
    Route::get('student/show/{id}', 'Module\StudentController@show')->name('students.show');

    //all pages
    Route::get('pages/index', 'Module\PageController@index')->name('pages.index');
    Route::get('pages/create', 'Module\PageController@create')->name('pages.create');
    Route::get('pages/delete/{id}', 'Module\PageController@destroy')->name('pages.destroy');
    Route::post('pages/store', 'Module\PageController@store')->name('pages.store')->middleware('demo');
    Route::get('pages/edit/{id}', 'Module\PageController@edit')->name('pages.edit');
    Route::post('pages/update', 'Module\PageController@update')->name('pages.update')->middleware('demo');
    Route::get('pages/active', 'Module\PageController@pageActive')->name('pages.active');
    Route::get('pages/content/index/{id}', 'Module\PageController@contentIndex')->name('pages.content.index');
    Route::get('pages/content/create/{id}', 'Module\PageController@contentCreate')->name('pages.content.create');
    Route::post('pages/content/store', 'Module\PageController@contentStore')->name('pages.content.store')->middleware('demo');
    Route::get('pages/content/active', 'Module\PageController@contentActive')->name('pages.content.active');
    Route::get('pages/content/edit/{id}', 'Module\PageController@contentEdit')->name('pages.content.edit');
    Route::post('pages/content/update', 'Module\PageController@contentUpdate')->name('pages.content.update')->middleware('demo');
    Route::get('pages/content/delete/{id}', 'Module\PageController@contentDestroy')->name('pages.content.destroy');

    /*theme settings*/
    Route::get('theme/setting', 'Module\ThemesController@create')->name('themes.setting');
    Route::post('theme/store', 'Module\ThemesController@store')->name('themes.store')->middleware('demo');

    /*affiliate setup*/
    if (affiliateStatus()){
        Route::get('affiliate/setting','Module\AffiliateController@settingCreate')->name('affiliate.setting.create');
        Route::post('affiliate/setting/update','Module\AffiliateController@settingStore')->name('affiliate.setting.update');
        Route::get('affiliate/index','Module\AffiliateController@requestList')->name('affiliate.request.list');
        Route::get('affiliate/reject/{id}','Module\AffiliateController@reject')->name('affiliate.reject');
        Route::get('affiliate/active/{id}','Module\AffiliateController@active')->name('affiliate.active');
        Route::get('affiliate/payment/request','Module\AffiliateController@paymentRequest')->name('affiliate.payment.request');
        Route::get('affiliate/student/account/{id}/{userId}/{method}/{payId}', 'Module\AffiliateController@accountDetails')
            ->name('student.account.details');
        Route::get('affiliate/payments/status/{id}', 'Module\AffiliateController@affiliateStatus')->name('affiliate.payments.status');
        Route::get('affiliate/payments/cancel/{id}', 'Module\AffiliateController@affiliatePaymentCancel')->name('affiliate.payment.request.cancel');
    }


    if (themeManager() == "rumbok"){

        /*know about module*/
        Route::get('know/index','KnowAboutController@index')->name('know.index');
        Route::get('know/create','KnowAboutController@create')->name('know.create');
        Route::post('know/store','KnowAboutController@store')->name('know.store');
        Route::get('know/edit/{id}','KnowAboutController@edit')->name('know.edit');
        Route::post('know/update','KnowAboutController@update')->name('know.update');
        Route::get('know/delete/{id}','KnowAboutController@destroy')->name('know.destroy');

        /*blog*/
        Route::get('blog/index','BlogController@index')->name('blog.index');
        Route::get('blog/create','BlogController@create')->name('blog.create');
        Route::post('blog/store','BlogController@store')->name('blog.store');
        Route::get('blog/edit/{id}','BlogController@edit')->name('blog.edit');
        Route::post('blog/update','BlogController@update')->name('blog.update');
        Route::get('blog/delete/{id}','BlogController@destroy')->name('blog.destroy');
        Route::get('blog/publish','BlogController@isActive')->name('blog.active');
    }
});



