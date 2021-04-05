<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Alert;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //show all category and search here
    public function index(Request $request)
    {
        $categories = null;
        if ($request->get('search')) {
            $search = $request->search;
            $categories = Category::where('name', 'like', '%' . $search . '%')
                ->with('parent')
                ->paginate(10);
        } else {
            $categories = Category::with('parent')->paginate(10);
        }
        return view('module.category.index', compact('categories'));
    }

    //create category model
    public function create()
    {
        $categories = Category::published()->where('parent_category_id', 0)->get();
        return view('module.category.create', compact('categories'));
    }

    //store the category
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => translate('Category name is required')
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_category_id = $request->parent_category_id ?? 0;

        //store the icon
        if ($request->has('icon')) {
            $category->icon = $request->icon;
        }
        $category->save();
        notify()->success(translate('Category created successfully'));
        return back();
    }

    //edit category model
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::published()
            ->where('parent_category_id', 0)
            ->get();
        return view('module.category.edit', compact('category', 'categories'));
    }

    //update the category
    public function update(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => translate('Category name is required')
        ]);


        $update_category = Category::where('id', $request->id)->first();
        $update_category->name = $request->name;
        $update_category->slug = Str::slug($update_category->name) . $update_category->id;
        $update_category->parent_category_id = $request->parent_category_id ?? 0;
        $update_category->icon = $request->icon;
        $update_category->save();

        notify()->success(translate('Category updated successfully'));
        return back();
    }

    //soft delete the category
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $course = Course::where('category_id', $id)->count();
        if ($course <= 0) {
            Category::where('id', $id)->delete();
            notify()->success(translate('Category deleted successfully'));
            return back();
        } else {
            notify()->info(translate('This category already in used.'));
            return back();
        }

    }

    //published
    public function published(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        // don't use this type of variable naming, use $category instead of $cat1
        $cat = Category::where('id', $request->id)->first();
        if ($cat->is_published == 1) {
            $cat->is_published = 0;
            $cat->save();
        } else {
            $cat->is_published = 1;
            $cat->save();
        }
        return response(['message' => translate('Category active status is changed ')], 200);
    }

    // published
    public function popular(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        // don't use this type of variable naming, use $category instead of $cat1
        $cat = Category::where('id', $request->id)->first();
        if ($cat->is_popular == 1) {
            $cat->is_popular = 0;
            $cat->save();
        } else {
            $cat->is_popular = 1;
            $cat->save();
        }
        return response(['message' => translate('Category popular status is changed')], 200);
    }

    // published
    public function top(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        // don't use this type of variable naming, use $category instead of $cat1
        $cat = Category::where('id', $request->id)->first();
        if ($cat->top == 1) {
            $cat->top = 0;
            $cat->save();
        } else {
            $cat->top = 1;
            $cat->save();
        }
        return response(['message' => translate('Category top status is changed')], 200);
    }

    //END
}
