<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Model\Category;

class CategoryController extends Controller
{
    /*
     * returns all published categories
     */

    public function index()
    {
        return CategoryResource::collection(Category::Published()->get())->additional(['success' => true, 'status' => 200]);
    }

}
