<?php

namespace App\Http\Controllers;

use App\Model\Instructor;
use App\Model\SystemSetting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use URL;

class InstallerController extends Controller
{
    protected function welcome()
    {
        overWriteEnvFile('APP_URL', URL::to('/'));
        return view('install.welcome');
    }

    // permission
    protected function permission()
    {
        $permission['curl_enabled'] = function_exists('curl_version');
        $permission['db_file_write_perm'] = is_writable(base_path('.env'));
        return view('install.permission', compact('permission'));
    }

    // create
    protected function create()
    {

        return view('install.setup');
    }

    //save database information in env file
    //here the get database key or data for env file
    // clear cache
    protected function dbStore(Request $request)
    {
        foreach ($request->types as $type) {
            //here the get database key or data for env file
            overWriteEnvFile($type, $request[$type]);
        }
        return redirect()->route('check.db');

    }

    // checkDbConnection
    protected function checkDbConnection()
    {
        try {
            //check the database connection for import the sql file
            DB::connection()->getPdo();

            return redirect()->route('sql.setup')->with('success', 'Your database connection done successfully');
        } catch (\Exception $e) {
            return redirect()->route('sql.setup')->with('wrong', 'Could not connect to the database. Please check your configuration');

        }
    }


    //import sql page
    protected function importSql()
    {
        return view('install.importSql');
    }

    //import the sql file in database or goto organization setup page
    protected function orgCreate()
    {
        try {
            //import the sql file in database
            $sql_path = base_path('install.sql');
            DB::unprepared(file_get_contents($sql_path));
            return view('install.setupOrg');
        } catch (Exception $e) {
            die("There are some problems, Please check your configuration. error:" . $e);
        }
    }


    /*import here demo data with instructor register form*/
    public function importDemoSql(){
        try {
            //import the sql file in database
            $sql_path = base_path('demo.sql');
            DB::unprepared(file_get_contents($sql_path));
            return view('install.instructorReg');
        } catch (Exception $e) {
            die("There are some problems, Please check your configuration. error:" . $e);
        }
    }

    /*instructor account create*/
    protected function instructorStore(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ],
            [
                'name.required' => translate('Name is required'),
                'email.required' => translate('Email is required'),
                'email.email' => translate('invalid email'),
                'email.unique' => translate('Email already exist'),
                'password.unique' => translate('Password is required'),
                'password.min' => translate('Password must be minimum 8 characters'),
                'password.confirmed' => translate('Password did not matched'),
            ]);
        //create admin and hash password
        $user = User::where('id',5)->first();
        $user->name = $request->name;
        $user->slug = Str::slug($request->name).'1';
        $user->email = $request->email;
        $user->verified = true;
        $user->password = Hash::make($request->password);
        $user->user_type = "Instructor";
        if ($user->save()) {
            $i = Instructor::where('user_id',5)->first();
            $i->email =$user->email;
            $i->name = $user->name;
            $i->save();
            return view('install.setupOrg');
        } else {
            return redirect()->back()->with('failed', translate('There are some problem try again'));
        }
    }

    //store the organization details in db
    protected function orgSetup(Request $request)
    {
        if ($request->hasFile('logo')) {
            $system = SystemSetting::where('type', $request->type_logo)->first();
            $system->value = fileUpload($request->logo, 'site');
            $system->save();
        }
        if ($request->has('name')) {
            $system = SystemSetting::where('type', $request->type_name)->first();
            $system->value = $request->name;
            $system->save();
            overWriteEnvFile('APP_NAME', $request->name);
        }
        if ($request->has('footer')) {
            $system = SystemSetting::where('type', $request->type_footer)->first();
            $system->value = $request->footer;
            $system->save();
        }
        if ($request->has('fb')) {
            $system = SystemSetting::where('type', $request->type_fb)->first();
            $system->value = $request->fb;
            $system->save();
        }
        if ($request->has('tw')) {
            $system = SystemSetting::where('type', $request->type_tw)->first();
            $system->value = $request->tw;
            $system->save();
        }
        if ($request->has('google')) {
            $system = SystemSetting::where('type', $request->type_google)->first();
            $system->value = $request->google;
            $system->save();
        }
        if ($request->has('address')) {
            $system = SystemSetting::where('type', $request->type_address)->first();
            $system->value = $request->address;
            $system->save();
        }
        if ($request->has('number')) {
            $system = SystemSetting::where('type', $request->type_number)->first();
            $system->value = $request->number;
            $system->save();
        }
        if ($request->has('mail')) {
            $system = SystemSetting::where('type', $request->type_mail)->first();
            $system->value = $request->mail;
            $system->save();
        }
        if ($request->has('f_logo')) {
            $system = SystemSetting::where('type', $request->footer_logo)->first();
            $system->value = fileUpload($request->f_logo,'site');
            $system->save();
        }
        if ($request->has('f_icon')) {
            $system = SystemSetting::where('type', $request->favicon_icon)->first();
            $system->value =fileUpload($request->f_icon,'site');
            $system->save();
        }
        return redirect()->route('admin.create');
    }

    //admin create page
    protected function adminCreate()
    {
        return view('install.user');
    }

    //create a admin with full access
    //save and add the super access permission
    // replace the RouteService provider when installation is done
    //return the dashboard when all is done
    protected function adminStore(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
          'name.required' => translate('Name is required'),
          'email.required' => translate('Email is required'),
          'email.email' => translate('invalid email'),
          'email.unique' => translate('Email already exist'),
          'password.unique' => translate('Password is required'),
          'password.min' => translate('Password must be minimum 8 characters'),
          'password.confirmed' => translate('Password did not matched'),
        ]);
        //create admin and hash password
        $user = new User();
        $user->name = $request->name;
        $user->slug = Str::slug($request->name);
        $user->email = $request->email;
        $user->verified = true;
        $user->password = Hash::make($request->password);
        $user->user_type = "Admin";

        // Response
        $response = Http::post('https://verify.softtech-it.com/public/api/courselmsbundle-verify-purchase-code', [
            'purchase_key' => $request->purchase_key,
            'ip_address' => $request->ip_address,
            'domain_name' => $request->domain_name
        ]);

        if($response == "continue"){
            if ($user->save()) {
                // $user->assignGroup(1);
                overWriteEnvFile('MIX_PUSHER_APP_CLUSTER_SECURE', '7469a286259799e5b37e5db9296f00b3');
                //replace the env file
                $se = Str::before(env('APP_URL'), '/public');
                overWriteEnvFile('APP_URL', $se);
                return view('install.done');
            } else {
                return redirect()->back()->with('failed', translate('Something is not appropriate! Try again.'));
            }
        }elseif ($response == "invalidKey"){
            return redirect()->back()->with('invalidKey', translate('Something is not appropriate! Try again.'));
        }elseif($response == "notManyvendor"){
            return redirect()->back()->with('notManyvendor', translate('Something is not appropriate! Try again.'));
        }else{
            return redirect()->back()->with('used', "This purchase key has already been used in ". $response .", contact the support team to transfer domain");
        }

    }


    

    //END
}
