<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">

    <title>Api Docs Learning Management System </title>
</head>
<body>

<div class="container">
    <h2 class="text-center text-primary">API Documentation V1</h2>
    <hr/>
    <p>End Point is: <kbd>https://host/api/v1/</kbd></p>
    <div class="container">
        <div class="row justify-content-md-center">

            <div class="col-md-3">
                <kbd>GET : /categories</kbd>
            </div>
            <div class="col-md-9">
                <p>Show all Published Categories</p>
                <pre>
                    <span>CategoryController->index</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET : /category/courses/{id}</kbd>
            </div>
            <div class="col-md-9">
                <p>Show Category Ways Latest Courses With Paginate</p>
                <pre>
                    <span> CourseApiController->catCourses(id)</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET : /sliders </kbd>
            </div>
            <div class="col-md-9">
                <p>Show all Publish slider</p>
                <pre>
                    <span>SettingApiController->sliders</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET : /site/setting</kbd>
            </div>
            <div class="col-md-9">
                <p>Show All Site Settings</p>
                <pre>
                    <span>SettingApiController->siteSetting</span>
                </pre>
            </div>


            <div class="col-md-3">
                <kbd>GET: /currencies</kbd>
            </div>
            <div class="col-md-9">
                <p>Show All active Currencies</p>
                <pre>
                    <span>SettingApiController->currencies</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET: /top/courses</kbd>
            </div>
            <div class="col-md-9">
                <p>Show top 10 active courses </p>
                <pre>
                    <span>CourseApiController->topCourses</span>
                </pre>
            </div>


            <div class="col-md-3">
                <kbd>GET: /free/courses</kbd>
            </div>
            <div class="col-md-9">
                <p>Show All active free courses with pagination</p>
                <pre>
                    <span>CourseApiController->freeCourses</span>
                </pre>
            </div>


            <div class="col-md-3">
                <kbd>GET: /search/courses</kbd>
            </div>
            <div class="col-md-9">
                <p>Search keyword in course title and Show the Matching active Courses with pagination</p>
                <pre>
                    <span>CourseApiController->searchCourses</span>
                    form-data: search
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET: /packages</kbd>
            </div>
            <div class="col-md-9">
                <p>Show all Active packages</p>
                <pre>
                    <span>InstructorApiController->packages</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>POST: /instructor/register</kbd>
            </div>
            <div class="col-md-9">
                <p>First Instructor register under a package, When all is ok, registration done successfully. System send a verify token in instructor email, if email is verify instructor can login </p>
                <pre>
                    <span>InstructorApiController->instructorRegister,</span>
                    form-data: package_id,name,email,password,amount,payment_method all is required
                </pre>
            </div>


            <div class="col-md-3">
                <kbd>GET: /instructors</kbd>
            </div>
            <div class="col-md-9">
                <p>Show all Instructor with pagination</p>
                <pre>
                    <span>InstructorApiController->instructors,</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET: /instructor/{id}/courses</kbd>
            </div>
            <div class="col-md-9">
                <p>Selected Instructor all active courses with pagination</p>
                <pre>
                    <span> InstructorApiController->instructorCourses,</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>POST: /student/register</kbd>
            </div>
            <div class="col-md-9">
                <p>When Student registration is successful, system a send verify email, For Login Student must be verify the account,Student can register social (provider id) with email id</p>
                <pre>
                    <span> StudentApiController->studentRegister,</span>
                    form-data: (name,email,password) ,(name,email,provider_id)
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET: student/verify/{verify-token}</kbd>
            </div>
            <div class="col-md-9">
                <p>For student account verify</p>
                <pre>
                    <span> StudentApiController->verifyUser,</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>POST: /student/login</kbd>
            </div>
            <div class="col-md-9">
                <p>If Student want to login else social login, Student must be verify, Every unverified login attempt system send a verify token mail. If login credential is wrong, return a error message,. if Login is Successfully system return a {access token} Every authenticated Action must be need this access token, system use <a href="https://laravel.com/docs/7.x/passport" class="nav-link">passport</a> for authentication</p>
                <pre>
                    <span> StudentApiController->studentLogin,</span>
                    form-data: (email, password),(email, provider id)
                </pre>
            </div>

            <div class="col-md-3">
                 <kbd>POST: /password/create</kbd>
            </div>
            <div class="col-md-9">
                <p>For New Password ,ForgotPassword</p>
                <pre>
                    <span> PasswordResetController->create,</span>
                form-data: email
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET: /password/find/{token}</kbd>
            </div>
            <div class="col-md-9">
                <p>Verify the token</p>
                <pre>
                    <span> PasswordResetController->find,</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>POST: /password/reset</kbd>
            </div>
            <div class="col-md-9">
                <p>Reset the password</p>
                <pre>
                    <span> PasswordResetController->reset,</span>
                  form-data: email,password,password_confirmation,token
                </pre>
            </div>


            <div class="col-md-3">
             auth  <kbd>POST: /student/update</kbd>
            </div>
            <div class="col-md-9">
                <p>Student update there profile, Login Student (id,email) must be required, and it's will be right id or email, if wrong update another student profile, so it's need extra care</p>
                <pre>
                    <span> StudentApiController->studentUpdate,</span>
                    form-date: id(required),email(required),phone,address,about,image,fb,tw,linked
                </pre>
            </div>


            <div class="col-md-3">
               auth <kbd>POST: /wishlist/create</kbd>
            </div>
            <div class="col-md-9">
                <p>Student add course in  Wishlist, only authorize student ken add course wishlist </p>
                <pre>
                    <span> WishlistApiController->wishlistStore,</span>
                    form-data: studentId, courseId,
                </pre>
            </div>



            <div class="col-md-3">
               auth <kbd>GET: 'wishlist/remove/{id}</kbd>
            </div>
            <div class="col-md-9">
                <p>Delete Course form wishlist</p>
                <pre>
                    <span> WishlistApiController->deleteWishlist,</span>
                </pre>
            </div>


            <div class="col-md-3">
              auth  <kbd>GET: /student/{id}/wishlist</kbd>
            </div>
            <div class="col-md-9">
                <p>Show Student all Wishlist, (id) is here is (userId)</p>
                <pre>
                    <span> WishlistApiController->allWishlist,</span>
                </pre>
            </div>


            <div class="col-md-3">
              auth  <kbd>POST: /add/to/cart</kbd>
            </div>
            <div class="col-md-9">
                <p>All cart Courses with Price save in database</p>
                <pre>
                    <span> WishlistApiController->addCart,</span>
                    form-data: studentId, courseId, (if not free the) coursePrice
                </pre>
            </div>

            <div class="col-md-3">
               auth <kbd>GET: /allCart/{id}</kbd>
            </div>
            <div class="col-md-9">
                <p>Show Student all Carts, (id) is here is (userId)</p>
                <pre>
                    <span> WishlistApiController->allCart,</span>
                </pre>
            </div>


            <div class="col-md-3">
               auth <kbd>GET: /remove/cart/{id}</kbd>
            </div>
            <div class="col-md-9">
                <p>Delete Cart</p>
                <pre>
                    <span> WishlistApiController->removeCart,</span>
                </pre>
            </div>

            <div class="col-md-3">
                auth <kbd>GET: /remove/cart/{id}</kbd>
            </div>
            <div class="col-md-9">
                <p>Delete Cart</p>
                <pre>
                    <span> WishlistApiController->removeCart,</span>
                </pre>
            </div>

            <div class="col-md-3">
                auth <kbd>POST: /enrollment</kbd>
            </div>
            <div class="col-md-9">
                <p>Delete Cart</p>
                <pre>
                    <span> EnrollmentApiController->enrollment,</span>
                form-data: all cart id in array[]
                </pre>
            </div>

            <div class="col-md-3">
                auth <kbd>GET: /enrollment/index/{id}</kbd>
            </div>
            <div class="col-md-9">
                <p>all Enrolment courses and show the purchase history (id) is here is (userId)</p>
                <pre>
                    <span> EnrollmentApiController->enrollmentCourses,</span>
                </pre>
            </div>

            <div class="col-md-3">
              auth  <kbd>POST: /message/send</kbd>
            </div>
            <div class="col-md-9">
                <p>Student Message enroll course instructor this message is private</p>
                <pre>
                    <span> EnrollmentApiController->sendMessage,</span>
                  form-data: enroll_id,user_id,message
                </pre>
            </div>

            <div class="col-md-3">
                auth  <kbd>GET: /message/inbox/{id}</kbd>
            </div>
            <div class="col-md-9">
                <p>Single enroll course against all message student or instructor</p>
                <pre>
                    <span> EnrollmentApiController->inboxMessage,</span>
                  form-data: enroll_id
                </pre>
            </div>

            <div class="col-md-3">
                auth <kbd>POST: /course/seen</kbd>
            </div>
            <div class="col-md-9">
                <p>Course ,Class, Class Content Seen Listed</p>
                <pre>
                    <span> CourseApiController->seenCourseListed,</span>
                    form-data: @class_id,@content_id,@course_id,@enroll_id,@user_id
                </pre>
            </div>

            <div class="col-md-3">
                auth <kbd>POST: /seen/history</kbd>
            </div>
            <div class="col-md-9">
                <p>Course ,Class, Class Content Seen History</p>
                <pre>
                    <span> CourseApiController->seenCourseListed,</span>
                    form-data: @class_id,@content_id,@course_id,@enroll_id required,@user_id required
                </pre>
            </div>

            <div class="col-md-3">
                auth <kbd>POST: /course/comment</kbd>
            </div>
            <div class="col-md-9">
                <p>Course against commenting there any one can replay or comment </p>
                <pre>
                    <span> EnrollmentApiController->comments,</span>
                    form-data: (@course_id,@user_id,@comments) for comment (@course_id,@user_id,@comments,@comment_id) for replay
                </pre>
            </div>

            <div class="col-md-3">
                auth <kbd>GET: /all/comments/{id}</kbd>
            </div>
            <div class="col-md-9">
                <p>Course against all commenting , id is here course_id </p>
                <pre>
                    <span> EnrollmentApiController->allComments,</span>
{{--                    form-data: @course_id,--}}
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET: /all/courses</kbd>
            </div>
            <div class="col-md-9">
                <p>All Courses</p>
                <pre>
                    <span>CourseApiController->allCourses,</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET: /course/{id}</kbd>
            </div>
            <div class="col-md-9">
                <p>Single Course Details</p>
                <pre>
                    <span>CourseApiController->singleCourse,</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET: /course/{id}</kbd>
            </div>
            <div class="col-md-9">
                <p>Single Class with Content Details</p>
                <pre>
                    <span>CourseApiController->class/{id},</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET: /content/{id}</kbd>
            </div>
            <div class="col-md-9">
                <p>Single Content Details</p>
                <pre>
                    <span>CourseApiController->singleContent,</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET: /languages</kbd>
            </div>
            <div class="col-md-9">
                <p>All Register languages</p>
                <pre>
                    <span>SettingApiController->languages,</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET: all/pages</kbd>
            </div>
            <div class="col-md-9">
                <p>All Active Pages With Contents</p>
                <pre>
                    <span>SettingApiController->allPages,</span>
                </pre>
            </div>

            <div class="col-md-3">
                <kbd>GET: single/page/{id}</kbd>
            </div>
            <div class="col-md-9">
                <p> Active Pages With Contents</p>
                <pre>
                    <span>SettingApiController->singlePage,</span>
                </pre>
            </div>



        </div>
    </div>

</div>

</body>
</html>
