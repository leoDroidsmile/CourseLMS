<?php

namespace App\Http\Controllers;

use App\Blog;
use Alert;
use App\Model\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->get('search')) {
            $search = $request->search;
            $blog = Blog::where('name', 'like', '%' . $search . '%')
                ->get();
        } else {
            $blog = Blog::all();
        }

        return view('module.blog.index', compact('blog'));
    }

    public function create()
    {
        $categories = Category::where('is_item', 0)->get();
        return view('module.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $blog = new Blog();
        $blog->category_id = $request->category_id;
        $blog->title = $request->name;
        $blog->img = $request->icon;
        $blog->body = $request->desc;
        $tag = explode(',', $request->tag);
        $tagC = array();
        foreach ($tag as $itemt) {
            array_push($tagC, $itemt);
        }
        $blog->tags = json_encode($tagC);
        $blog->save();
        notify()->success(translate('Blog Content created successfully'));
        return back();
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Category::where('is_item', 0)->get();
        return view('module.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $blog = Blog::findOrFail($request->id);
        $blog->category_id = $request->category_id;
        $blog->title = $request->name;
        $blog->img = $request->icon;
        $blog->body = $request->desc;
        $tag = explode(',', $request->tag);
        $tagC = array();
        foreach ($tag as $itemt) {
            array_push($tagC, $itemt);
        }
        $blog->tags = json_encode($tagC);
        $blog->save();
        notify()->success(translate('Blog Content update successfully'));
        return back();
    }


    public function destroy(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $blog = Blog::findOrFail($request->id);
        $blog->delete();
        notify()->success(translate('Blog Content delete successfully'));
        return back();
    }

    public function isActive(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $blog = Blog::findOrFail($request->id);
        if ($blog->is_active == 1) {
            $blog->is_active = 0;
        } else {
            $blog->is_active = 1;
        }
        $blog->save();
        return response(['message' => translate('Blog content status is changed')], 200);
    }


}
