<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Course;
use App\Page;
use Alert;
use App\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    //all pages
    public function index()
    {
        $pages = Page::all();
        return view('module.page.index', compact('pages'));
    }

//create form
    public function create()
    {
        return view('module.page.create');
    }

    //store page
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => translate('Title is Required'),
        ]);
        $page = new Page();
        $page->title = $request->title;
        $page->slug =Str::slug($request->title);
        $page->save();

        notify()->success(translate('Page created successfully'));
        return back();
    }

    /*page Update view*/
    public function edit($id)
    {
        $page = Page::where('id', $id)->firstOrFail();
        return view('module.page.edit', compact('page'));
    }


    /*update save*/
    public function update(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        $request->validate([
            'title' => 'required',
            'id' => 'required',
        ], [
            'title.required' => translate('Title is Required'),
            'is.required' => translate('Please reload the page'),
        ]);
        $page = Page::where('id', $request->id)->firstOrFail();
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->save();

        notify()->success(translate('Page created successfully'));
        return back();

    }

    /*Delete the page*/
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        Page::where('id', $id)->delete();
        PageContent::where('page_id', $id)->delete();
        notify()->info(translate('Page deleted successfully'));
        return back();

    }

    /*page ways content */
    public function contentIndex($id)
    {
        $content = PageContent::where('page_id', $id)->get();
        return view('module.page.content.index', compact('content', 'id'));
    }


    /*content create*/
    public function contentCreate($id)
    {
        return view('module.page.content.create', compact('id'));
    }

    /*Content Create*/
    public function contentStore(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'page_id' => 'required',
            'body' => 'required',
        ], [
            'page_id.required' => translate('Page Is Required'),
            'body.required' => translate('Body Is Required'),
        ]);
        $content = new PageContent();
        $content->page_id = $request->page_id;
        $content->title = $request->title;
        $content->body = $request->body;
        $content->save();
        notify()->success(translate('Page content created successfully'));
        return back();
    }

    /*Page Content Edit*/
    public function contentEdit($id)
    {
        $content = PageContent::where('id', $id)->firstOrFail();
        return view('module.page.content.edit', compact('content'));
    }

    /*Content Update*/
    public function contentUpdate(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'page_id' => 'required',
            'body' => 'required',
        ], [
            'page_id.required' => translate('Page is required'),
            'body.required' => translate('Body is required'),
        ]);
        $content = PageContent::where('id', $request->id)->firstOrFail();
        $content->page_id = $request->page_id;
        $content->title = $request->title;
        $content->body = $request->body;
        $content->save();
        notify()->success(translate('Page content updated successfully'));
        return back();
    }

    /*Content Delete*/
    public function contentDestroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $content = PageContent::where('id', $id)->delete();
        notify()->warning(translate('Content deleted successfully'));
        return back();
    }

    /*Active the page content*/
    public function contentActive(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $content = PageContent::where('id', $request->id)->firstOrFail();
        if ($content->active == 1) {
            $content->active = 0;
        } else {
            $content->active = 1;
        }
        $content->save();
        return response(['message' => translate('Page content status is changed')], 200);
    }


    /*Active the Page*/
    public function pageActive(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $page = Page::where('id', $request->id)->firstOrFail();
        if ($page->active == 1) {
            $page->active = 0;
        } else {
            $page->active = 1;
        }
        $page->save();
        return response(['message' => translate('Page status is changed')], 200);
    }
}
