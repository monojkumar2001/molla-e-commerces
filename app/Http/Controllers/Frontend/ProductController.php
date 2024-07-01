<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class ProductController extends Controller
{
    public function getCategory($slug, $subSlug = null, $subSubSlug = null)
    {
        $category = Category::where('slug', $slug)->first();
        if (!empty($category)) {
            $data['meta_title'] = $category->meta_title;
            $data['meta_keywords'] = $category->meta_keywords;
            $data['meta_description'] = $category->meta_description;
        }

        $sub_category = null;

        if ($subSlug) {
            $sub_category = SubCategory::where('slug', $subSlug)->first();
            $data['meta_title'] = $sub_category->meta_title;
            $data['meta_keywords'] = $sub_category->meta_keywords;
            $data['meta_description'] = $sub_category->meta_description;
        }
        $sub_sub_category = null;

        if ($subSubSlug) {
            $sub_sub_category = SubSubCategory::where('slug', $subSubSlug)->first();
            $data['meta_title'] = $sub_sub_category->meta_title;
            $data['meta_keywords'] = $sub_sub_category->meta_keywords;
            $data['meta_description'] = $sub_sub_category->meta_description;
        }


        if ($category || $sub_category || $sub_sub_category) {
            return view('frontend.product.list', compact('category', 'sub_category', 'sub_sub_category'), $data);
        } else {
            abort(404, 'Category, SubCategory, or SubSubCategory not found');
        }
    }
}
