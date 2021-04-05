<?php

namespace App\Http\Controllers;

use App\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Http;
use ZipArchive;
use App\Addon;
use File;
use Alert;
use Auth;
use DB;
use Artisan;

class AddonController extends Controller
{

    // addons_manager

    public function addons_manager()
    {

        try {
            //check DB table for migration
            if (!Schema::hasTable('addons')) {
                \Artisan::call('make:model Addon');

                Schema::create('addons', function (Blueprint $table) {
                    $table->id();
                    $table->string('name')->nullable();
                    $table->string('unique_identifier')->nullable();
                    $table->string('version')->nullable();
                    $table->boolean('activated')->default(true);
                    $table->longText('image')->nullable();
                    $table->timestamps();
                });

                \Artisan::call('optimize:clear');
            }

            // view
            return view('addon.index');

        } catch (\Throwable $th) {
            Alert::toast(translate('Something went wrong'), translate('error'));
            return back();
        }

    }

    // Addons UI
    public function installui()
    {
        return view('addon.install');
    }

    // -----------------------------------GET MAIN PAGE-----------------------------------------------------------------
    public function get_index_page()
    {
        $addons = Addon::all();
        return view('addon.ajax.index', compact('addons'));
    }


    // get_install_page
    public function get_install_page()
    {
        return view('addon.ajax.install');
    }
    // -----------------------------------GET MAIN PAGE:END--------------------------------------------------------------


    // addon_preview
    public function addon_preview($addon)
    {
        $preview_addon = Addon::where('name', $addon)->first();
        return view('addon.preview_modal', compact('preview_addon'));
    }

    // addon_status
    public function addon_status($addon)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        // Store to DB
        $status = Addon::where('name', $addon)->first();

        try {
            if ($status->activated == 0) {
                $status->activated = 1;

                switch ($status->name) {
                    case 'paytm':
                        overWriteEnvFile('PAYTM_ACTIVE', 'YES');
                        break;
                    case 'zoom':
                        overWriteEnvFile('ZOOM_ACTIVE', 'YES');
                        break;
                    case  'certificate':
                        overWriteEnvFile('CERTIFICATE_ACTIVE', 'YES');
                        break;
                    case 'quiz':
                        overWriteEnvFile('QUIZ_ACTIVE', 'YES');
                        break;
                    case 'forum':
                       overWriteEnvFile('FORUM_PANEL', 'YES');
                        break;
                    case 'subscription':
                       overWriteEnvFile('SUBSCRIPTION_ACTIVE', 'YES');
                        break;
                    case 'coupon':
                       overWriteEnvFile('COUPON_ACTIVE', 'YES');
                        break;

                    default:
                        notify()->error(translate('Something went wrong.'));
                        return back();
                        break;
                }

            } else {
                $status->activated = 0;

                switch ($status->name) {
                    case 'paytm':
                        overWriteEnvFile('PAYTM_ACTIVE', 'NO');
                        break;
                    case 'zoom':
                        overWriteEnvFile('ZOOM_ACTIVE', 'NO');
                        break;
                    case 'certificate':
                        overWriteEnvFile('CERTIFICATE_ACTIVE', 'NO');
                        break;
                    case 'quiz':
                        overWriteEnvFile('QUIZ_ACTIVE', 'NO');
                        break;
                    case 'forum':
                       overWriteEnvFile('FORUM_PANEL', 'NO');
                        break;
                    case 'subscription':
                       overWriteEnvFile('SUBSCRIPTION_ACTIVE', 'NO');
                        break;
                    case 'coupon':
                       overWriteEnvFile('COUPON_ACTIVE', 'NO');
                        break;

                    default:
                        notify()->error(translate('Something went wrong.'));
                        return back();
                        break;
                }
            }

            $status->save();
            // Store to DB:END

            notify()->success(translate('Status changed.'));
            return back();
        } catch (\Throwable $th) {
            notify()->error(translate('Something went wrong.'));
            return back();
        }
    }

    // addon_setup
    public function addon_setup($addon)
    {

        try {
            // paytm
            if ($addon == 'paytm') {

                $addon_name = $addon;
                $purchase_code = null;
                return view('addon.setup.paytm.paytm_account', compact('addon_name', 'purchase_code'));
            }
            // paytm::END

            // zoom
            if ($addon == 'zoom') {

                $addon_name = $addon;
                $purchase_code = null;
                return view('addon.setup.zoom.zoom_upload', compact('addon_name', 'purchase_code'));
            }
            // zoom::END

            // quiz
            if ($addon == 'quiz') {

                $addon_name = $addon;
                $purchase_code = null;
                return view('addon.setup.quiz.quiz_upload', compact('addon_name', 'purchase_code'));
            }
            // quiz::END

            // forum
            if ($addon == 'forum') {

                $addon_name = $addon;
                $purchase_code = null;
                return view('addon.setup.forum.forum_upload', compact('addon_name','purchase_code'));
            }
            // forum::END

            /*certificate*/
            if ($addon == 'certificate') {
                $addon_name = $addon;
                $purchase_code = null;
                return view('addon.setup.certificate.certificate_upload', compact('addon_name', 'purchase_code'));
            }

            /*subscription*/
            if ($addon == 'subscription') {
                $addon_name = $addon;
                $purchase_code = null;
                return view('addon.setup.subscription.subscription_upload', compact('addon_name', 'purchase_code'));
            }

            /*coupon*/
            if ($addon == 'coupon') {
                $addon_name = $addon;
                $purchase_code = null;
                return view('addon.setup.coupon.coupon_upload', compact('addon_name', 'purchase_code'));
            }

            /*coupon*/
            if ($addon == 'wallet') {
                $addon_name = $addon;
                $purchase_code = null;
                return view('addon.setup.wallet.wallet_upload', compact('addon_name', 'purchase_code'));
            }

        } catch (\Throwable $th) {
            notify()->error(translate('Something went wrong.'));
            return back();
        }

    }


    // purchase_code_verify
    public function purchase_code_verify(Request $request, $addon)
    {
        $addon_name = $request->addon_name;
        $purchase_code = $request->purchase_code;

        /**
        * PAYTM
        */
        try {
            if ($addon == 'paytm') {
                return view('addon.setup.paytm.paytm_account', compact('addon_name', 'purchase_code'));
            }
        } catch (\Throwable $th) {
            notify()->error(translate('Something went wrong.'));
            return back();
        }

    }

    // paytm_account_setup
    public function paytm_account_setup(Request $request)
    {

        

        try {
            $addon_name = $request->addon_name;
            $purchase_code = $request->purchase_code ?? 'N/A';
            $paytm_environment = $request->paytm_environment;
            $paytm_merchant_id = $request->paytm_merchant_id;
            $paytm_merchant_key = $request->paytm_merchant_key;
            $paytm_merchant_website = $request->paytm_merchant_website;
            $paytm_channel = $request->paytm_channel;
            $paytm_industry_type = $request->paytm_industry_type;

            return $this->paytmFileUpload(
                $addon_name,
                $purchase_code,
                $paytm_environment,
                $paytm_merchant_id,
                $paytm_merchant_key,
                $paytm_merchant_website,
                $paytm_channel,
                $paytm_industry_type
            );
        } catch (\Throwable $th) {
            notify()->error(translate('Something went wrong.'));
            return back();
        }
    }


    // paytmFileUpload
    public function paytmFileUpload(
        $addon_name,
        $purchase_code,
        $paytm_environment,
        $paytm_merchant_id,
        $paytm_merchant_key,
        $paytm_merchant_website,
        $paytm_channel,
        $paytm_industry_type
    )
    {

        try {
            return view('addon.setup.paytm.paytm_upload', compact(
                'addon_name',
                'purchase_code',
                'paytm_environment',
                'paytm_merchant_id',
                'paytm_merchant_key',
                'paytm_merchant_website',
                'paytm_channel',
                'paytm_industry_type'
            ));
        } catch (\Throwable $th) {
            notify()->error(translate('Something went wrong.'));
            return back();
        }

    }


    // Extracting Addons to addons folder

    public function index(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }



        try {


            if ($file = $request->file('addons')) { //-----1

                /**
                 * Zip Upload
                 */

                $name = $file->getClientOriginalName(); // file name
                $file->move(base_path('addons/'), $name); // storing file
                $fileNameWithoutExtension = explode('.', $name)[0]; // Filename without extension

                // Redirecting to Addons function
                if ($fileNameWithoutExtension === 'paytm') {

                    if (!paytmRouteForBlade()) { //-----paytm

                        $addon_name = $request->addon_name;
                        $purchase_code = $request->purchase_code;
                        $paytm_environment = $request->paytm_environment;
                        $paytm_merchant_id = $request->paytm_merchant_id;
                        $paytm_merchant_key = $request->paytm_merchant_key;
                        $paytm_merchant_website = $request->paytm_merchant_website;
                        $paytm_channel = $request->paytm_channel;
                        $paytm_industry_type = $request->paytm_industry_type;

                        // calling payTM()
                        return $this->paytm(
                            $addon_name,
                            $purchase_code,
                            $paytm_environment,
                            $paytm_merchant_id,
                            $paytm_merchant_key,
                            $paytm_merchant_website,
                            $paytm_channel,
                            $paytm_industry_type
                        );
                        // calling payTM():END
                    } else { //-----zoom
                        notify()->warning(translate('Addon Already Installed.'));
                        return redirect()->route('addons.manager.index');
                    }
                    // Redirecting to Addons function::END
                }// end paytm
                elseif ($fileNameWithoutExtension === 'zoom') {

                    if (!zoomRouteForBlade()) { //-----zoom

                        $addon_name = $request->addon_name;
                        $purchase_code = $request->purchase_code;

                        // calling zoom()
                        return $this->zoom($addon_name,$purchase_code);
                        // calling zoom():END
                    } else { //-----zoom
                        notify()->warning(translate('Addon Already Installed.'));
                        return redirect()->route('addons.manager.index');
                    }
                }// end zoom
                elseif ($fileNameWithoutExtension === 'quiz') {

                    if (!quizRouteForBlade()) { //-----quiz

                        $addon_name = $request->addon_name;
                        $purchase_code = $request->purchase_code;

                        // calling quiz()
                        return $this->quiz($addon_name,$purchase_code);
                        // calling quiz():END
                    } else { //-----zoom
                        notify()->warning(translate('Addon Already Installed.'));
                        return redirect()->route('addons.manager.index');
                    }
                }
                elseif ($fileNameWithoutExtension == 'certificate') {

                    if (!certificateForRoute()) { //-----certificate
                        $addon_name = $request->addon_name;
                        $purchase_code = $request->purchase_code;


                        return $this->certificate($addon_name, $purchase_code);
                        // calling certificate():END
                    } else { //-----zoom
                        notify()->warning(translate('Addon Already Installed.'));
                        return redirect()->route('addons.manager.index');
                    }
                } // end quiz
                elseif($fileNameWithoutExtension === 'forum'){

                    if (!forumRouteForBlade()) { //-----forum

                        $addon_name = $request->addon_name;
                        $purchase_code = $request->purchase_code;

                        // calling forum()
                        return $this->forum($addon_name,$purchase_code);
                        // calling forum():END
                    }else{ //-----zoom
                        notify()->warning(translate('Addon Already Installed.'));
                        return redirect()->route('addons.manager.index');
                    }
                } //----- end forum
                elseif($fileNameWithoutExtension === 'subscription'){

                    if (!subscriptionRouteForBlade()) { //-----subscription

                        $addon_name = $request->addon_name;
                        $purchase_code = $request->purchase_code;

                        // calling subscription()
                        return $this->subscription($addon_name,$purchase_code);
                        // calling subscription():END
                    }else{ //-----subscription
                        notify()->warning(translate('Addon Already Installed.'));
                        return redirect()->route('addons.manager.index');
                    }
                } //----- end subscription
                elseif($fileNameWithoutExtension === 'coupon'){

                    if (!couponRouteForBlade()) { //-----coupon

                        $addon_name = $request->addon_name;
                        $purchase_code = $request->purchase_code;

                        // calling subscription()
                        return $this->coupon($addon_name,$purchase_code);
                        // calling subscription():END
                    }else{ //-----subscription
                        notify()->warning(translate('Addon Already Installed.'));
                        return redirect()->route('addons.manager.index');
                    }
                } //----- end coupon
                elseif($fileNameWithoutExtension === 'wallet'){

                    if (!walletRouteForBlade()) { //-----wallet

                        $addon_name = $request->addon_name;
                        $purchase_code = $request->purchase_code;

                        // calling subscription()
                        return $this->wallet($addon_name,$purchase_code);
                        // calling subscription():END
                    }else{ //-----subscription
                        notify()->warning(translate('Addon Already Installed.'));
                        return redirect()->route('addons.manager.index');
                    }
                } //----- end wallet
                else{ //----- check install
                    notify()->warning(translate('Addon Already Installed.'));
                    return redirect()->route('addons.manager.index');
                }

            } else { //------1
                notify()->error(translate('Invalid Addon File.'));
                return redirect()->route('addons.manager.index');
            }

       } catch (\Throwable $th) {
           notify()->error(translate('Something went wrong.'));
           return back();
       }
    }


    // paytm::START
    public function paytm(
        $addon_name,
        $purchase_code,
        $paytm_environment,
        $paytm_merchant_id,
        $paytm_merchant_key,
        $paytm_merchant_website,
        $paytm_channel,
        $paytm_industry_type
    )
    {

        try {
            // Store to DB
            $paytm = new Addon();
            $paytm->name = $addon_name;
            $paytm->unique_identifier = $purchase_code;
            $paytm->version = 1.0;
            $paytm->activated = true;
            $paytm->image = 'paytm-banner.jpg';
            $paytm->save();
            // Store to DB:END


            /**
             * Extract
             */

            $zip = new ZipArchive;

            $public_dir = base_path() . '/addons'; //addons path

            $extract_dir = base_path() . '/addons'; // extracted addons path

            $zipFileName = 'paytm.zip'; // Uploaded addons name

            $filetopath = $public_dir . '/' . $zipFileName; // find addons file

            if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                $zip->extractTo($extract_dir); // extracting zip
                $zip->close();

                unlink(base_path() . '/addons/' . $zipFileName);
            }

            /**
             * Move Files to Folder
             */


            /**
             * Controller
             */

            //  /addons/patym/controllers
            $controller_from_path = base_path() . '/addons/paytm/Controllers/PaytmController.php'; // From folder path
            $controller_to_path = base_path() . '/app/Http/Controllers/PaytmController.php'; // Coping to folder Path

            File::copy($controller_from_path, $controller_to_path);

            /**
             * Controller:END
             */

            /**
             * Route
             */

            //  /addons/paytm/paytm.php
            $route_from_path = base_path() . '/addons/paytm/paytm.php'; // From folder path
            $route_to_path = base_path() . '/routes/paytm.php'; // Coping to folder Path

            File::copy($route_from_path, $route_to_path);

            /**
             * Route:END
             */

            /**
             * Overwrite ENV
             */

            overWriteEnvFile('PAYTM_ENVIRONMENT', $paytm_environment);
            overWriteEnvFile('PAYTM_MERCHANT_ID', $paytm_merchant_id);
            overWriteEnvFile('PAYTM_MERCHANT_KEY', $paytm_merchant_key);
            overWriteEnvFile('PAYTM_MERCHANT_WEBSITE', $paytm_merchant_website);
            overWriteEnvFile('PAYTM_CHANNEL', $paytm_channel);
            overWriteEnvFile('PAYTM_INDUSTRY_TYPE', $paytm_industry_type);
            overWriteEnvFile('PAYTM_ACTIVE', 'YES');


            /**
             * Overwrite ENV::END
             */

            Alert::toast(translate('success'), translate('Package installed'));
            return redirect()->route('addons.manager.index');

        } catch (\Throwable $th) {
            Alert::toast(translate('Installation Failed'), translate('error'));
            return back();
        }

    }

    // paytm::END

    /*quiz addons*/
    public function quiz($addon_name, $purchase_code)
    {
        try {
            /*check table have quizzes*/
            if (!Schema::hasTable('quizzes')) {
                Schema::create('quizzes', function (Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->unsignedBigInteger('user_id');
                    $table->unsignedBigInteger('course_id');
                    $table->integer('quiz_time')->nullable(); //this is for start time
                    $table->float('pass_mark');
                    $table->boolean('status');
                    $table->integer('number_of_attempts')->nullable();
                    $table->timestamps();
                });
            }

            /*questions check table*/
            if (!Schema::hasTable('questions')) {
                Schema::create('questions', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('user_id');
                    $table->unsignedBigInteger('quiz_id');
                    $table->longText('question');
                    $table->float('grade');
                    $table->longText('options');
                    $table->boolean('status')->default(true);
                    $table->timestamps();
                });
            }

            /*score table*/
            if (!Schema::hasTable('quiz_scores')) {
                Schema::create('quiz_scores', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('quiz_id');
                    $table->unsignedBigInteger('user_id');
                    $table->unsignedBigInteger('content_id');
                    $table->unsignedBigInteger('course_id');
                    $table->integer('minutes'); //how time to solved this quiz
                    $table->float('score');
                    $table->float('wrong');
                    $table->float('right');
                    $table->string('status');
                    $table->timestamps();
                });
            }

            \Artisan::call('optimize:clear');

            if (Schema::hasTable('class_contents') && !Schema::hasColumn('class_contents', 'quiz_id')) {
                DB::statement("ALTER TABLE class_contents ADD COLUMN quiz_id BIGINT (20) NULL;");
            }


            // Store to DB
            $zoom = new Addon();
            $zoom->name = $addon_name;
            $zoom->unique_identifier = $purchase_code;
            $zoom->version = 1.0;
            $zoom->activated = true;
            $zoom->image = 'quiz-banner.jpg';
            $zoom->save();
            // Store to DB:END

            /**
             * Extract
             */

            $zip = new ZipArchive;

            $public_dir = base_path() . '/addons'; //addons path

            $extract_dir = base_path() . '/addons'; // extracted addons path

            $zipFileName = 'quiz.zip'; // Uploaded addons name

            $filetopath = $public_dir . '/' . $zipFileName; // find addons file

            if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                $zip->extractTo($extract_dir); // extracting zip
                $zip->close();

                unlink(base_path() . '/addons/' . $zipFileName);
            }

            /**
             * Move Files to Folder
             */

            /**
             * Controller
             */

            //  /addons/zoom/controllers
            $controller_from_path = base_path() . '/addons/quiz/Controllers/QuizController.php'; // From folder path
            $controller_to_path = base_path() . '/app/Http/Controllers/QuizController.php'; // Coping to folder Path

            File::copy($controller_from_path, $controller_to_path);

            /**
             * Controller:END
             */


            /**
             * Route
             */

            $route_from_path = base_path() . '/addons/quiz/routes/quiz.php'; // From folder path
            $route_to_path = base_path() . '/routes/quiz.php'; // Coping to folder Path

            File::copy($route_from_path, $route_to_path);

            /**
             * Route:END
             */


            /**
             * MODEL
             */

            $question_model_from_path = base_path() . '/addons/quiz/Model/Question.php'; // From folder path
            $question_model_to_path = base_path() . '/app/Question.php'; // Coping to folder Path
            File::copy($question_model_from_path, $question_model_to_path);

            $quiz_model_from_path = base_path() . '/addons/quiz/Model/Quiz.php'; // From folder path
            $quiz_model_to_path = base_path() . '/app/Quiz.php'; // Coping to folder Path
            File::copy($quiz_model_from_path, $quiz_model_to_path);

            $quizscore_model_from_path = base_path() . '/addons/quiz/Model/QuizScore.php'; // From folder path
            $quizscore_model_to_path = base_path() . '/app/QuizScore.php'; // Coping to folder Path
            File::copy($quizscore_model_from_path, $quizscore_model_to_path);

            /**
             * MODEL:END
             */


            /**
             * views/zoom
             */

            //  /addons/zoom/views/zoom
            $quiz_dashboard_from_path = base_path() . '/addons/quiz/views'; // From folder path
            $quiz_dashboard_to_path = base_path() . '/resources/views/addon/view'; // Coping to folder Path

            File::copyDirectory($quiz_dashboard_from_path, $quiz_dashboard_to_path);

            /**
             * views/zoom:END
             */

            // Overwrite ENV

            overWriteEnvFile('QUIZ_ACTIVE', 'YES');

            // Overwrite ENV:END

            Alert::toast(translate('success'), translate('Package installed'));
            return redirect()->route('addons.manager.index');

        } catch (\Exception $exception) {
            Alert::toast(translate('Installation Failed'), translate('error'));
            return back();
        }
    }

    // zoom::START
    public function zoom($addon_name, $purchase_code)
    {

        try {

            //check DB table for migration
            if (!Schema::hasTable('meetings')) {
                Schema::create('meetings', function (Blueprint $table) {
                    $table->id();
                    $table->string('meeting_id', 191);
                    $table->integer('user_id')->nullable();
                    $table->string('owner_id', 191);
                    $table->longText('meeting_title')->nullable();
                    $table->dateTime('start_time');
                    $table->longText('zoom_url', 191);
                    $table->longText('link_by')->nullable();
                    $table->longText('type')->nullable();
                    $table->longText('agenda')->nullable();
                    $table->integer('course_id')->nullable();
                    $table->timestamps();
                });

                \Artisan::call('optimize:clear');
            }

            if (Schema::hasTable('class_contents') && !Schema::hasColumn('class_contents', 'meeting_id')) {
                DB::statement("ALTER TABLE class_contents ADD COLUMN meeting_id BIGINT (20) NULL;");
            }

            if (Schema::hasTable('users') && !Schema::hasColumn('users', 'zoom_email') && !Schema::hasColumn('users', 'jwt_token')) {
                DB::statement("ALTER TABLE users ADD COLUMN zoom_email LONGTEXT NULL;");
                DB::statement("ALTER TABLE users ADD COLUMN jwt_token LONGTEXT NULL;");
            }

            if (Schema::hasTable('class_contents') && Schema::hasColumn('class_contents', 'video_url')) {
                DB::statement("ALTER TABLE class_contents MODIFY video_url LONGTEXT;");
            }

            // Store to DB
            $zoom = new Addon();
            $zoom->name = $addon_name;
            $zoom->unique_identifier = $purchase_code;
            $zoom->version = 1.0;
            $zoom->activated = true;
            $zoom->image = 'zoom-banner.jpg';
            $zoom->save();
            // Store to DB:END


            /**
             * Extract
             */

            $zip = new ZipArchive;

            $public_dir = base_path() . '/addons'; //addons path

            $extract_dir = base_path() . '/addons'; // extracted addons path

            $zipFileName = 'zoom.zip'; // Uploaded addons name

            $filetopath = $public_dir . '/' . $zipFileName; // find addons file

            if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                $zip->extractTo($extract_dir); // extracting zip
                $zip->close();

                unlink(base_path() . '/addons/' . $zipFileName);
            }

            /**
             * Move Files to Folder
             */


            /**
             * Controller
             */

            //  /addons/zoom/controllers
            $controller_from_path = base_path() . '/addons/zoom/Controllers/ZoomController.php'; // From folder path
            $controller_to_path = base_path() . '/app/Http/Controllers/ZoomController.php'; // Coping to folder Path

            File::copy($controller_from_path, $controller_to_path);

            /**
             * Controller:END
             */

            /**
             * Route
             */

            //  /addons/zoom/routes/zoom.php
            $route_from_path = base_path() . '/addons/zoom/routes/zoom.php'; // From folder path
            $route_to_path = base_path() . '/routes/zoom.php'; // Coping to folder Path

            File::copy($route_from_path, $route_to_path);

            /**
             * Route:END
             */


            /**
             * MODEL
             */

            //  /addons/zoom/Model/Zoom.php
            $zoom_model_from_path = base_path() . '/addons/zoom/Model/Zoom.php'; // From folder path
            $zoom_model_to_path = base_path() . '/app/Zoom.php'; // Coping to folder Path

            File::copy($zoom_model_from_path, $zoom_model_to_path);


            //  /addons/zoom/routes/zoom.php
            $meeting_model_from_path = base_path() . '/addons/zoom/Model/Meeting.php'; // From folder path
            $meeting_model_to_path = base_path() . '/app/Meeting.php'; // Coping to folder Path

            File::copy($meeting_model_from_path, $meeting_model_to_path);

            /**
             * MODEL:END
             */


            /**
             * views/zoom
             */

            //  /addons/zoom/views/zoom
            $zoom_dashboard_from_path = base_path() . '/addons/zoom/views/zoom'; // From folder path
            $zoom_dashboard_to_path = base_path() . '/resources/views/zoom'; // Coping to folder Path

            File::copyDirectory($zoom_dashboard_from_path, $zoom_dashboard_to_path);

            /**
             * views/zoom:END
             */

            // Overwrite ENV

            overWriteEnvFile('ZOOM_ACTIVE', 'YES');

            // Overwrite ENV:END

            Alert::toast(translate('success'), translate('Package installed'));
            return redirect()->route('addons.manager.index');

        } catch (\Throwable $th) {
            Alert::toast(translate('Installation Failed'), translate('error'));
            return back();
        }

    }

    // forum::START
    public function forum(
        $addon_name,
        $purchase_code
    )
    {

        try {

            //check DB table for migration
            if (!Schema::hasTable('forums')) {
                Schema::create('forums', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->longText('title');
                $table->longText('discussion')->nullable();
                $table->unsignedBigInteger('category');
                $table->timestamps();
                });
            }


            if (!Schema::hasTable('post_replies')) {
                Schema::create('post_replies', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('post_id');
                $table->longText('reply')->nullable();
                $table->timestamps();
                });
            }


            if (!Schema::hasTable('helpful_answers')) {
                Schema::create('helpful_answers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('post_reply_id');
                $table->unsignedBigInteger('post_id');
                $table->unsignedBigInteger('user_id');
                $table->timestamps();
                });
            }


            if (!Schema::hasTable('forum_post_views')) {
                Schema::create('forum_post_views', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('post_id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->ipAddress('ip_address')->nullable();
                $table->timestamps();
                });
            }



            // Store to DB
            $forum = new Addon();
            $forum->name = $addon_name;
            $forum->unique_identifier = $purchase_code;
            $forum->version = 1.0;
            $forum->activated = true;
            $forum->image = 'forum-banner.jpg';
            $forum->save();
            // Store to DB:END

            /**
             * Extract
             */

            $zip = new ZipArchive;

            $public_dir=base_path().'/addons'; //addons path

            $extract_dir=base_path().'/addons'; // extracted addons path

            $zipFileName = 'forum.zip'; // Uploaded addons name

            $filetopath = $public_dir.'/'.$zipFileName; // find addons file

            if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                $zip->extractTo($extract_dir); // extracting zip
                $zip->close();

                unlink(base_path().'/addons/'.$zipFileName);
            }

            /**
             * Move Files to Folder
             */


            /**
             * Controller
             */

            //  /addons/zoom/controllers
            $forum_controller_from_path = base_path().'/addons/forum/Conrtollers/ForumController.php'; // From folder path
            $forum_controller_to_path = base_path() . '/app/Http/Controllers/ForumController.php'; // Coping to folder Path

            File::copy($forum_controller_from_path, $forum_controller_to_path);

            /**
             * Controller:END
             */

            /**
             * Route
             */

            //  /addons/zoom/routes/zoom.php
            $forum_route_from_path = base_path().'/addons/forum/routes/forum.php'; // From folder path
            $forum_route_to_path = base_path() . '/routes/forum.php'; // Coping to folder Path

            File::copy($forum_route_from_path, $forum_route_to_path);

            /**
             * Route:END
             */


            /**
             * MODEL
             */

            //  /addons/zoom/Model/Zoom.php
            $forum_model_from_path = base_path().'/addons/forum/Model/Forum.php'; // From folder path
            $forum_model_to_path = base_path() . '/app/Forum.php'; // Coping to folder Path

            File::copy($forum_model_from_path, $forum_model_to_path);


            //  /addons/zoom/routes/zoom.php
            $forum_postview_model_from_path = base_path().'/addons/forum/Model/ForumPostView.php'; // From folder path
            $forum_postview_model_to_path = base_path() . '/app/ForumPostView.php'; // Coping to folder Path

            File::copy($forum_postview_model_from_path, $forum_postview_model_to_path);


            //  /addons/zoom/routes/zoom.php
            $forum_helpful_model_from_path = base_path().'/addons/forum/Model/HelpfulAnswer.php'; // From folder path
            $forum_helpful_model_to_path = base_path() . '/app/HelpfulAnswer.php'; // Coping to folder Path

            File::copy($forum_helpful_model_from_path, $forum_helpful_model_to_path);


            //  /addons/zoom/routes/zoom.php
            $forum_reply_model_from_path = base_path().'/addons/forum/Model/PostReply.php'; // From folder path
            $forum_reply_model_to_path = base_path() . '/app/PostReply.php'; // Coping to folder Path

            File::copy($forum_reply_model_from_path, $forum_reply_model_to_path);

            /**
             * MODEL:END
             */


            /**
             * views/zoom
             */

            //  /addons/zoom/views/zoom
            $forum_dashboard_from_path = base_path().'/addons/forum/views/forum'; // From folder path
            $forum_dashboard_to_path = base_path() . '/resources/views/forum'; // Coping to folder Path

            File::copyDirectory($forum_dashboard_from_path, $forum_dashboard_to_path);

            /**
             * views/zoom:END
             */

            // Overwrite ENV

            overWriteEnvFile('FORUM_PANEL', 'YES');
            overWriteEnvFile('FORUM_UI', 'forumly');

            // Overwrite ENV:END

            Alert::toast(translate('success'), translate('Package installed'));
            return redirect()->route('addons.manager.index');

        } catch (\Throwable $th) {
            Alert::toast(translate('Installation Failed'), translate('error'));
            return back();
        }

    }

    // forum::END

    //certificate :: START
    public function certificate($addon_name, $purchase_code)
    {


      try {
        //check DB table for migration
        if (!Schema::hasTable('certificates')) {

            Schema::create('certificates', function (Blueprint $table) {
                $table->id();
                $table->longText('template_text')->nullable();
                $table->longText('top_text')->nullable();
                $table->longText('header_text')->nullable();
                $table->longText('footer_text')->nullable();
                $table->string('permissions')->nullable();
                $table->string('image')->nullable();
                $table->string('badge')->nullable();
                $table->string('logo')->nullable();
                $table->timestamps();
            });

        }

        if (!Schema::hasTable('certificate_stores')) {
            Schema::create('certificate_stores', function (Blueprint $table) {
                $table->id();
                $table->string('uid')->nullable();
                $table->integer('user_id')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            });

        }

        if (Schema::hasTable('instructors') && !Schema::hasColumn('instructors', 'signature')) {
            DB::statement("ALTER TABLE instructors ADD COLUMN signature LONGTEXT  NULL;");
        }


        // Store to DB
        $certificate = new Addon();
        $certificate->name = $addon_name;
        $certificate->unique_identifier = $purchase_code;
        $certificate->version = 1.0;
        $certificate->activated = true;
        $certificate->image = 'certificate-banner.jpg';
        $certificate->save();
        // Store to DB:END


        /**
         * Extract
         */

        $zip = new ZipArchive;

        $public_dir = base_path() . '/addons'; //addons path

        $extract_dir = base_path() . '/addons'; // extracted addons path

        $zipFileName = 'certificate.zip'; // Uploaded addons name

        $filetopath = $public_dir . '/' . $zipFileName; // find addons file

        if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
            $zip->extractTo($extract_dir); // extracting zip
            $zip->close();

            unlink(base_path() . '/addons/' . $zipFileName);
        }

        /**
         * Move Files to Folder
         */


        /**
         * Controller
         */
        $controller_from_path = base_path() . '/addons/certificate/Controllers/CertificateController.php'; // From folder path
        $controller_to_path = base_path() . '/app/Http/Controllers/CertificateController.php'; // Coping to folder Path
        File::copy($controller_from_path, $controller_to_path);
        /**
         * Controller:END
         */


        /**
         * Route
         */
        $route_from_path = base_path() . '/addons/certificate/routes/certificate.php'; // From folder path
        $route_to_path = base_path() . '/routes/certificate.php'; // Coping to folder Path
        File::copy($route_from_path, $route_to_path);
        /**
         * Route:END
         */


        /**
         * MODEL
         */
        /*model 1*/
        $certificate_model_from_path = base_path() . '/addons/certificate/Model/Certificate.php'; // From folder path
        $certificate_model_to_path = base_path() . '/app/Certificate.php'; // Coping to folder Path
        File::copy($certificate_model_from_path, $certificate_model_to_path);


        //model 2
        $certificate_store_model_from_path = base_path() . '/addons/certificate/Model/CertificateStore.php'; // From folder path
        $certificate_store_model_to_path = base_path() . '/app/CertificateStore.php'; // Coping to folder Path
        File::copy($certificate_store_model_from_path, $certificate_store_model_to_path);

        /**
         * MODEL:END
         */


        /**
         * views/certificate
         */
        $certificate_dashboard_from_path = base_path() . '/addons/certificate/views/certificate'; // From folder path
        $certificate_dashboard_to_path = base_path() . '/resources/views/addon/view/certificate'; // Coping to folder Path
        File::copyDirectory($certificate_dashboard_from_path, $certificate_dashboard_to_path);

        /**
         * views/certificate:END
         */

        /*save certificate*/
        $certificate = new Certificate();
        $certificate->top_text = 'CERTIFICATE OR ACHIEVEMENT';
        $certificate->header_text = 'THIS CERTIFICATE IS PROUDLY PRESENTED TO';
        $certificate->footer_text = 'FOR THE SUCCESSFUL COMPLETION OF';
        $certificate->permissions = 'NO';
        $certificate->image = 'uploads/certificate/c-1.jpg';;
        $certificate->save();
        // Overwrite ENV
        overWriteEnvFile('CERTIFICATE_ACTIVE', 'YES');
        // Overwrite ENV:END
        Alert::toast(translate('success'), translate('Package installed'));
        return redirect()->route('addons.manager.index');

      } catch (\Throwable $th) {
          Alert::toast(translate('Installation Failed'), translate('error'));
          return back();
      }
    }

    // subscription::START
    public function subscription(
        $addon_name,
        $purchase_code
    )
    {

        try {

            // Store to DB
            $forum = new Addon();
            $forum->name = $addon_name;
            $forum->unique_identifier = $purchase_code;
            $forum->version = 1.0;
            $forum->activated = true;
            $forum->image = 'subscription-preview.jpg';
            $forum->save();
            // Store to DB:END

            /**
             * Extract
             */

            $zip = new ZipArchive;

            $public_dir=base_path().'/addons'; //addons path

            $extract_dir=base_path().'/addons'; // extracted addons path

            $zipFileName = 'subscription.zip'; // Uploaded addons name

            $filetopath = $public_dir.'/'.$zipFileName; // find addons file

            if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                $zip->extractTo($extract_dir); // extracting zip
                $zip->close();

                unlink(base_path().'/addons/'.$zipFileName);
            }

            /**
             * Move Files to Folder
             */


            /**
             * Controller
             */

            //  /addons/subscription/controllers
            $subscription_controller_from_path = base_path().'/addons/subscription/Controllers/SubscriptionController.php'; // From folder path
            $subscription_controller_to_path = base_path() . '/app/Http/Controllers/SubscriptionController.php'; // Coping to folder Path

            File::copy($subscription_controller_from_path, $subscription_controller_to_path);

            /**
             * Controller:END
             */

            /**
             * Route
             */

            //  /addons/zoom/routes/subscription.php
            $subscription_route_from_path = base_path().'/addons/subscription/routes/subscription.php'; // From folder path
            $subscription_route_to_path = base_path() . '/routes/subscription.php'; // Coping to folder Path

            File::copy($subscription_route_from_path, $subscription_route_to_path);

            /**
             * Route:END
             */


            /**
             * views/subscription
             */

            //  /addons/subscription/views/subscription
            $subscription_dashboard_from_path = base_path().'/addons/subscription/views/subscription'; // From folder path
            $subscription_dashboard_to_path = base_path() . '/resources/views/subscription'; // Coping to folder Path

            File::copyDirectory($subscription_dashboard_from_path, $subscription_dashboard_to_path);

            /**
             * views/subscription:END
             */

            // Overwrite ENV

            overWriteEnvFile('SUBSCRIPTION_ACTIVE', 'YES');

            \Artisan::call('db:seed --class=SubscriptionSeeder');


            // Overwrite ENV:END

            Alert::toast(translate('success'), translate('Package installed'));
            return redirect()->route('addons.manager.index');

        } catch (\Throwable $th) {
            Alert::toast(translate('Installation Failed'), translate('error'));
            return back();
        }

    }

    /**
     * COUPON
     */

     // coupon::START
    public function coupon(
        $addon_name,
        $purchase_code
    )
    {

        try {

            // Store to DB
            $forum = new Addon();
            $forum->name = $addon_name;
            $forum->unique_identifier = $purchase_code;
            $forum->version = 1.0;
            $forum->activated = true;
            $forum->image = 'coupon-preview.jpg';
            $forum->save();
            // Store to DB:END



            if (!Schema::hasTable('coupons')) {
                Schema::create('coupons', function (Blueprint $table) {
                    $table->id();
                    $table->string('code')->unique();
                    $table->double('rate');
                    $table->dateTime('start_day');
                    $table->dateTime('end_day');
                    $table->double('min_value')->nullable();
                    $table->boolean('is_published')->default(false);
                    $table->timestamps();
                });
            }


            /**
             * Extract
             */

            $zip = new ZipArchive;

            $public_dir=base_path().'/addons'; //addons path

            $extract_dir=base_path().'/addons'; // extracted addons path

            $zipFileName = 'coupon.zip'; // Uploaded addons name

            $filetopath = $public_dir.'/'.$zipFileName; // find addons file

            if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                $zip->extractTo($extract_dir); // extracting zip
                $zip->close();

                unlink(base_path().'/addons/'.$zipFileName);
            }

            /**
             * Move Files to Folder
             */


            /**
             * Controller
             */

            //  /addons/coupon/app/Http/Controllers/
            $coupon_controller_from_path = base_path().'/addons/coupon/app/Http/Controllers/CouponController.php'; // From folder path
            $coupon_controller_to_path = base_path() . '/app/Http/Controllers/CouponController.php'; // Coping to folder Path

            File::copy($coupon_controller_from_path, $coupon_controller_to_path);

            /**
             * Controller:END
             */


            /**
             * Model
             */

            //  /addons/coupon/app/Http/Coupon.php
            $coupon_model_from_path = base_path().'/addons/coupon/app/Coupon.php'; // From folder path
            $coupon_model_to_path = base_path() . '/app/Coupon.php'; // Coping to folder Path

            File::copy($coupon_model_from_path, $coupon_model_to_path);

            /**
             * Model:END
             */

            /**
             * Route
             */

            //  /addons/coupon/routes/coupon.php
            $coupon_route_from_path = base_path().'/addons/coupon/routes/coupon.php'; // From folder path
            $coupon_route_to_path = base_path() . '/routes/coupon.php'; // Coping to folder Path

            File::copy($coupon_route_from_path, $coupon_route_to_path);

            /**
             * Route:END
             */


            /**
             * views/subscription
             */

            //  /addons/coupon/views/coupon
            $coupon_dashboard_from_path = base_path().'/addons/coupon/views/coupon'; // From folder path
            $coupon_dashboard_to_path = base_path() . '/resources/views/'; // Coping to folder Path

            File::copyDirectory($coupon_dashboard_from_path, $coupon_dashboard_to_path);

            /**
             * views/subscription:END
             */

            // Overwrite ENV

            overWriteEnvFile('COUPON_ACTIVE', 'YES');

            // Overwrite ENV:END

            Alert::toast(translate('success'), translate('Package installed'));
            return redirect()->route('addons.manager.index');

        } catch (\Throwable $th) {
            Alert::toast(translate('Installation Failed'), translate('error'));
            return back();
        }

    }

     // wallet::START
    public function wallet(
        $addon_name,
        $purchase_code
    )
    {

        try {

            // Store to DB
            $forum = new Addon();
            $forum->name = $addon_name;
            $forum->unique_identifier = $purchase_code;
            $forum->version = 1.0;
            $forum->activated = true;
            $forum->image = 'wallet-preview.jpg';
            $forum->save();
            // Store to DB:END



            if (!Schema::hasTable('wallets')) {
                Schema::create('wallets', function (Blueprint $table) {
                    $table->id();
                    $table->string('wallet_name')->nullable();
                    $table->string('wallet_icon')->nullable();
                    $table->double('wallet_rate')->nullable();
                    $table->double('redeem_limit')->nullable();
                    $table->double('registration_point')->nullable();
                    $table->double('free_course_point')->nullable();
                    $table->double('paid_course_point')->nullable();
                    $table->double('course_complete_point')->nullable();
                    $table->timestamps();
                });
            }


            if (!Schema::hasTable('point_transactions')) {
                Schema::create('point_transactions', function (Blueprint $table) {
                    $table->increments('id');
                    $table->text('message');
                    $table->morphs('pointable');
                    $table->bigInteger('amount');
                    $table->unsignedBigInteger('current');
                    $table->timestamps();
                });
            }


            if (!Schema::hasTable('redeem_course_points')) {
                Schema::create('redeem_course_points', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('course_id');
                    $table->unsignedBigInteger('user_id');
                    $table->timestamps();
                });
            }


            /**
             * Extract
             */

            $zip = new ZipArchive;

            $public_dir=base_path().'/addons'; //addons path

            $extract_dir=base_path().'/addons'; // extracted addons path

            $zipFileName = 'wallet.zip'; // Uploaded addons name

            $filetopath = $public_dir.'/'.$zipFileName; // find addons file

            if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                $zip->extractTo($extract_dir); // extracting zip
                $zip->close();

                unlink(base_path().'/addons/'.$zipFileName);
            }

            /**
             * Move Files to Folder
             */


            /**
             * Controller
             */

            //  /addons/wallet/Controllers/
            $wallet_controller_from_path = base_path().'/addons/wallet/Controllers/WalletController.php'; // From folder path
            $wallet_controller_to_path = base_path() . '/app/Http/Controllers/WalletController.php'; // Coping to folder Path

            File::copy($wallet_controller_from_path, $wallet_controller_to_path);

            /**
             * Controller:END
             */


            /**
             * Model
             */

            //  /addons/wallet/Models/Wallet.php
            $wallet_model_from_path = base_path().'/addons/wallet/Models/Wallet.php'; // From folder path
            $wallet_model_to_path = base_path() . '/app/Wallet.php'; // Coping to folder Path

            File::copy($wallet_model_from_path, $wallet_model_to_path);

            //  /addons/wallet/Models/RedeemCoursePoint.php
            $RedeemCoursePoint_model_from_path = base_path().'/addons/wallet/Models/RedeemCoursePoint.php'; // From folder path
            $RedeemCoursePoint_to_path = base_path() . '/app/RedeemCoursePoint.php'; // Coping to folder Path

            File::copy($RedeemCoursePoint_model_from_path, $RedeemCoursePoint_to_path);

            /**
             * Model:END
             */

            /**
             * Route
             */

            //  /addons/wallet/routes/wallet.php
            $wallet_route_from_path = base_path().'/addons/wallet/routes/wallet.php'; // From folder path
            $wallet_route_to_path = base_path() . '/routes/wallet.php'; // Coping to folder Path

            File::copy($wallet_route_from_path, $wallet_route_to_path);

            /**
             * Route:END
             */


            /**
             * views/wallet
             */

            //  /addons/coupon/views/wallet
            $wallet_dashboard_from_path = base_path().'/addons/wallet/views/'; // From folder path
            $wallet_dashboard_to_path = base_path() . '/resources/views/'; // Coping to folder Path

            File::copyDirectory($wallet_dashboard_from_path, $wallet_dashboard_to_path);

            /**
             * views/wallet:END
             */

            // Overwrite ENV

            overWriteEnvFile('WALLET_ACTIVE', 'YES');

            // Overwrite ENV:END

            Alert::toast(translate('success'), translate('Package installed'));
            return redirect()->route('addons.manager.index');

        } catch (\Throwable $th) {
            Alert::toast(translate('Installation Failed'), translate('error'));
            return back();
        }

    }
    //wallet::end

    //END
}
