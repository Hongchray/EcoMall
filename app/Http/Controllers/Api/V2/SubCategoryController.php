<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\SubCategoryCollection;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function index($id)
    {
        return new SubCategoryCollection(SubCategory::where('category_id', $id)->get());
    }
}
