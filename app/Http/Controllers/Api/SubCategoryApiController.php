<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;

class SubCategoryApiController extends Controller
{
    /**
     * Display a listing of the subcategories.
     *
     * @return variable
     */
    public function subcategories($id)
    {
        $subCategories = SubCategory::where('category_id', '=', $id)->get();
        return $subCategories;
    }
}
