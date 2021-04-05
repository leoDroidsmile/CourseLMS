<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Model\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Alert;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //list of language
    public function index()
    {
        $languages = Language::all();
        return view('setting.lang.language')->with('languages', $languages);
    }


    //store a  new language
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'code' => ['required', 'unique:languages'],
            'name' => ['required', 'unique:languages'],
            'image' => ['required', 'unique:languages']
        ]);
        $lan = new Language();
        $lan->code = $request->code;
        $lan->name = $request->name;
        $lan->image = $request->image;
        $lan->save();
        notify()->success(translate('Language created successfully'));
        return back();
    }

    //delete the language
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        Language::where('id', $id)->forceDelete();
        notify()->success(translate('Language deleted successfully'));
        return redirect()->route('language.index');
    }


    //languages for create translate
    public function translate_create($id)
    {
        
        $lang = Language::findOrFail($id);
        return view('setting.lang.translate')->with('lang', $lang);
    }


    //translate language save ase a json format file
    public function translate_store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $language = Language::findOrFail($request->id);

        //check the key have translate data
        $data = openJSONFile($language->code);
        foreach ($request->translations as $key => $value) {
            $data[$key] = $value;
        }

        //save the new keys translate data
        saveJSONFile($language->code, $data);
        notify()->success(translate('Translation saved.'));
        return back();
    }

    //change the language
    public function changeLanguage(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        session(['locale' => $request->code]);
        Artisan::call('optimize:clear');
        return back();
    }


    //defaultLanguage
    public function defaultLanguage($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        $language = Language::findOrFail($id);
        overWriteEnvFile('DEFAULT_LANGUAGE', $language->code);
        Artisan::call('view:clear');
        return redirect()->back()->with('success', translate('Language is default or changed '));
    }
    //END
}
