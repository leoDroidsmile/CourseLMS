<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/





Route::group(['namespace' => 'API\V1', 'prefix' => 'v1' ,'middleware'=>'install.check'],
    function () {

        /*Api Documentation*/
        Route::get('/', function () {
            return view('docs.api');
        });
        /*All Categories*/
        Route::get('/categories', 'CategoryController@index');

        //category courses
        //@category_id
        Route::get('/category/courses/{id}', 'CourseApiController@catCourses');

        //slider
        Route::get('/sliders', 'SettingApiController@sliders');

        /*Site setting*/
        Route::get('/site/setting', 'SettingApiController@siteSetting');

        /*All currencies*/
        Route::get('/currencies', 'SettingApiController@currencies');

        //package
        Route::get('packages', 'InstructorApiController@packages');


        /*top courses*/
        Route::get('top/courses', 'CourseApiController@topCourses');


        /*free courses*/
        Route::get('free/courses', 'CourseApiController@freeCourses');

        /*search  courses*/
        Route::get('search/courses', 'CourseApiController@searchCourses');

        /*Instructor Register*/
        //@package_id
        //@name
        //@email
        //@password
        //@amount
        //@payment_method
        Route::post('instructor/register', 'InstructorApiController@instructorRegister');


        /*all instructor*/
        Route::get('instructors', 'InstructorApiController@instructors');

        /*Instructor ways course*/
        //@instructor_id
        Route::get('instructor/{id}/courses/', 'InstructorApiController@instructorCourses');


        /*
         * There are student section
         * student can create account
         * @name
         * @email
         * @password
         * */
        Route::post('/student/register', 'StudentApiController@studentRegister');


        /*Student Verify */
        /*@token*/
        Route::get('student/verify/{token}', 'StudentApiController@verifyUser');


        /*Student Login
        * @email
         * @password
        */
        Route::post('/student/login', 'StudentApiController@studentLogin');

        /*Student password reset
        * @email
        */
        Route::post('password/create', 'PasswordResetController@create');

        /*Verify the token*/
        Route::get('password/find/{token}', 'PasswordResetController@find');

        /*Reset password
        *@email
        *@password
        *@password_confirmation
        *@token
        */
        Route::post('password/reset', 'PasswordResetController@reset');

        /**
         * Update Student Profile
         * @phone
         * @id
         * @email
         * @address
         * @about
         * @image
         * @fb
         * @tw
         * @linked
         */
        Route::post('student/update', 'StudentApiController@studentUpdate')->middleware(['auth:api']);

        /*
         * WishList create
         * @studentId
         * @courseId
         * @coursePrice
         * */
        Route::post('wishlist/create', 'WishlistApiController@wishlistStore')->middleware('auth:api');

        //remove wishlist
        //@id
        Route::get('wishlist/remove/{id}', 'WishlistApiController@deleteWishlist')->middleware('auth:api');

        //all wishlist
        //@user_id
        Route::get('student/{id}/wishlist', 'WishlistApiController@allWishlist')->middleware('auth:api');

        /*Add Cart Store in database
        *@studentId
        *@courseId
        *@coursePrice
         */
        Route::post('add/to/cart', 'WishlistApiController@addCart')->middleware('auth:api');

        /*All Cart
        *@user_id
        */
        Route::get('allCart/{id}', 'WishlistApiController@allCart')->middleware('auth:api');

        /*remove Cart
       *@car id
       */
        Route::get('remove/cart/{id}', 'WishlistApiController@removeCart')->middleware('auth:api');
        /*Enrollment
        *@id[1,2,3] all cart id array
         * @payment_method
        */
        Route::post('enrollment', 'EnrollmentApiController@enrollment')->middleware('auth:api');


        //all Enrolment courses and show the purchase history
        //@user_id
        Route::get('enrollment/index/{id}', 'EnrollmentApiController@enrollmentCourses')->middleware('auth:api');

        /*Student Messaging to Instructor
        *@enroll_id
        *@user_id
        *@message
        */
        Route::post('message/send','EnrollmentApiController@sendMessage')->middleware('auth:api');


        /*Enroll course ways messages list
        *@enroll_id
        */
        Route::get('message/inbox/{id}','EnrollmentApiController@inboxMessage')->middleware('auth:api');


        /*Commenting
        * @course_id
        * @user_id // student
        * @comments
        * @comment_id //if replay
         * */
        Route::post('course/comment','EnrollmentApiController@comments');


        /*all Commenting against course id
        * @course_id
         * */
        Route::get('all/comments/{id}','EnrollmentApiController@allComments');


        /*Course ,Class, Class Content Seen Listed*/
        //@class_id
        //@content_id
        //@course_id
        //@enroll_id
        //@user_id
        Route::post('/course/seen','CourseApiController@seenCourseListed')->middleware('auth:api');


        /*Course ,Class, Class Content Seen History*/
        //@class_id
        //@content_id
        //@course_id
        //@enroll_id required
        //@user_id required
        Route::post('/seen/history','CourseApiController@seenHistory')->middleware('auth:api');


        //show all courses
        Route::get('all/courses', 'CourseApiController@allCourses');


        //single course
        //@course_id
        Route::get('course/{id}', 'CourseApiController@singleCourse');

        //single class
        //@class_id
        Route::get('class/{id}', 'CourseApiController@singleClass');

        //single content
        /*content_id*/
        Route::get('content/{id}', 'CourseApiController@singleContent');

        /*all language*/
        Route::get('languages','SettingApiController@languages');

        /*ALl Pages*/
        Route::get('all/pages','SettingApiController@allPages');

        /*single page*/
        Route::get('single/page/{id}','SettingApiController@singlePage');



    });
