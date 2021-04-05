<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alert;

class ThemesController extends Controller
{
    //

    public function create()
    {
        return view('setting.themes');
    }


    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        foreach ($request->types as $key => $type) {
            overWriteEnvFile($type, $request[$type]);
        }
        notify()->success(translate('Themes settings update'));
        return back();
    }
}
