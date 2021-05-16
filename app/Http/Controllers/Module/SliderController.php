<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Model\Slider;
use Illuminate\Http\Request;
use Alert;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // slider list
    public function index()
    {
        $sliders = Slider::all();
        return view('module.slider.index', compact('sliders'));
    }
    // slider create form
    public function create()
    {
        return view('module.slider.create');
    }
    // slider store
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'image' => 'required'
        ],
        [
          'image.required'  => translate('Slider image is required')
        ]);

        $slider = new Slider();

        if ($request->has('image')) {
            $slider->image = $request->image;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->url = $request->url;
        $slider->save();

        notify()->success(translate('Slide created successfully'));
        return back();
    }

    // slider edit
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('module.slider.edit', compact('slider'));
    }

    // slider update
    public function update(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'image' => 'required'
        ],
        [
          'image.required'  => translate('Slider image is required')
        ]);

        $slider = Slider::findOrFail($request->id);
        
        if ($request->has('image')) {
            $slider->image = $request->image;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->url = $request->link;
        $slider->save();
        notify()->success(translate('Slider updated successfully'));
        return back();
    }

    // slider destroy
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $slider = Slider::findOrFail($id);
        $slider->delete();
        notify()->success(translate('Slider deleted successfully'));
        return back();
    }

    // published
    public function published(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        // don't use this type of variable naming, use $category instead of $cat1
        $slider = Slider::where('id', $request->id)->first();
        if ($slider->is_published == 1) {
            $slider->is_published = 0;
            $slider->save();
        } else {
            $slider->is_published = 1;
            $slider->save();

            // //all is unpublished
            // $sliders = Slider::whereNotIn('id',[$request->id])->get();
            // foreach ($sliders as $item){
            //     $item->is_published =0;
            //     $item->save();
            // }

        }
        return response(['message' => translate('Slider status is changed ')], 200);
    }
    //END
}
