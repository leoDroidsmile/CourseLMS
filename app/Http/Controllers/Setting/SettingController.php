<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Model\SystemSetting;
use App\Page;
use Alert;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    //smtp View
    public function smtpCreate()
    {

        return view('setting.smtp.smtp');
    }

    //there are store the smtp setting get all request,
    // data and overWrite in overWriteEnvFile() in .env file
    public function smtpStore(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        foreach ($request->types as $key => $type) {
            overWriteEnvFile($type, $request[$type]);
        }
        notify()->success(translate('Mail setup done successfully'));
        return back();
    }


    /*All site setting here*/
    public function siteSetting(){
        return view('setting.siteSetting');
    }

    /*update the site setting*/
    public  function siteSettingUpdate(Request $request){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        if ($request->hasFile('logo')) {
            $system = SystemSetting::where('type', $request->type_logo)->first();
            $system->value = fileUpload($request->logo,'site');
            $system->save();
        }
        if ($request->has('name')) {
            $system = SystemSetting::where('type', $request->type_name)->first();
            $system->value = $request->name;
            $system->save();
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

        if ($request->has('type_affiliate')) {
            $system = SystemSetting::where('type', $request->type_affiliate)->first();
            $system->value =$request->affiliate;
            $system->save();
        }
        notify()->success(translate('Site settings done'));
        return back();
    }


    /*All app setting here*/
    public function appSetting(){
        return view('setting.appSetting');
    }

    /*update the site setting*/
    public  function appSettingUpdate(Request $request){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        foreach ($request->types as $key => $type) {
            overWriteEnvFile($type, $request[$type]);
        }

        notify()->success(translate('Apps setup done successfully'));
        return back();
    }


    /*other setting*/
    public function otherSetting(){
        return view('setting.other');
    }

    Public function otherSettingUpdate(Request  $request){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        foreach ($request->types as $key => $type) {
            overWriteEnvFile($type, $request[$type]);
        }
        notify()->success(translate('Others setting is  done successfully'));
        return back();
    }


    //END
}
