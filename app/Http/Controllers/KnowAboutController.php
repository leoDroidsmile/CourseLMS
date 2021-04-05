<?php

namespace App\Http\Controllers;

use App\KnowAbout;
use Illuminate\Http\Request;
use Alert;

class KnowAboutController extends Controller
{
    //
    public function index(){
        $knowAbouts = KnowAbout::all();
        return view('module.knowabout.index',compact('knowAbouts'));
    }

    public function create(){
        return view('module.knowabout.create');
    }

    public function store(Request $request){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $know = new KnowAbout();
        $know->icon = $request->icon;
        $know->title = $request->title;
        $know->desc = $request->desc;
        $know->align = $request->align;
        $know->video = $request->video;
        if ($request->hasFile('image')){
            $know->image =    fileUpload($request->image,'know');
        }
        $know->save();
        notify()->success(translate('Content created successfully'));
        return back();
    }


    public function edit($id){
        $know = KnowAbout::find($id);
        return view('module.knowabout.edit',compact('know'));
    }

    public function update(Request $request){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $know = KnowAbout::where('id',$request->id)->first();
        $know->icon = $request->icon;
        $know->title = $request->title;
        $know->desc = $request->desc;
        $know->video = $request->video;
        if ($request->hasFile('image')){
            fileDelete($know->image);
            $know->image =    fileUpload($request->image,'know');
        }
        $know->save();

        notify()->success(translate('Content update successfully'));
        return back();
    }

    public function destroy($id){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        KnowAbout::find($id)->delete();
        notify()->success(translate('Content delete successfully'));
        return back();
    }
}
