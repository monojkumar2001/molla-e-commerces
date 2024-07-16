<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function getCategory($slug, $subSlug = null, $subSubSlug = null)
    {
        $category = Category::where('slug', $slug)->first();
        $products = Product::where('category_id', $category->id);
        $sub_category = null;
        $sub_sub_category = null;

        if ($subSlug) {
            $sub_category = SubCategory::where('slug', $subSlug)->firstOrFail();
            $products = $products->where('sub_category_id', $sub_category->id);
        }

        if ($subSubSlug) {
            $sub_sub_category = SubSubCategory::where('slug', $subSubSlug)->firstOrFail();
            $products = $products->where('sub_sub_category_id', $sub_sub_category->id);
        }

        $products = $products->with('productImages')->paginate(12);

        // Retrieve colors based on the filtered products
        $colors = Color::get();
        $brands = Brand::get();
        // dd($colors);


        $data['meta_title'] = $sub_sub_category->meta_title ?? $sub_category->meta_title ?? $category->meta_title;
        $data['meta_keywords'] = $sub_sub_category->meta_keywords ?? $sub_category->meta_keywords ?? $category->meta_keywords;
        $data['meta_description'] = $sub_sub_category->meta_description ?? $sub_category->meta_description ?? $category->meta_description;

        if ($category || $sub_category || $sub_sub_category) {
            return view('frontend.product.list', compact('category', 'brands', 'colors', 'sub_category', 'products', 'sub_sub_category'), $data);
        } else {
            abort(404, 'Category, SubCategory, or SubSubCategory not found');
        }
    }
    public function getFilterProduct(Request $request)
    {
        $products = Product::query();

        if ($request->filled('sub_category_id')) {
            $subCategoryIds = explode(',', rtrim($request->sub_category_id, ','));
            $products->whereIn('sub_category_id', $subCategoryIds);
        } else {
            if ($request->filled('old_category_id')) { {
                    $products->where(
                        'category_id',
                        $request->filled('old_category_id')
                    );
                }
            }
            if ($request->filled('old_sub_category_id')) { {
                    $products->where('old_sub_category_id', $request->old_sub_category_id);
                }
            }
        }

        if ($request->filled('brand_id')) {
            $brandIds = explode(',', rtrim($request->brand_id, ','));
            $products->whereIn('brand_id', $brandIds);
        }

        if ($request->filled('color_id')) {
            $colorIds = explode(',', rtrim($request->color_id, ','));
            $products->whereHas('productColors', function ($query) use ($colorIds) {
                $query->whereIn('color_id', $colorIds);
            });
        }

        if ($request->filled('start_price') && $request->filled('end_price')) {
            $start_price = (int) str_replace('৳', '', $request->start_price);
            $end_price = (int) str_replace('৳', '', $request->end_price);
            $products->whereBetween('discount_price', [$start_price, $end_price]);
        }



        if ($request->filled('sort_by_id')) {
            $sortBy = $request->sort_by_id;
            switch ($sortBy) {
                case 'price_asc':
                    $products->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $products->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $products->orderBy('created_at', 'desc');
                    break;
                case 'popularity':
                    // Add your own logic for popularity sorting
                    break;
            }
        }

        $products = $products->with('productImages', 'category')->get();
        $html = view('frontend.product.list_items', compact('products'))->render();

        return response()->json(['html' => $html]);
    }

    public function getSingleProduct($slug)
    {
        $product = Product::where("slug", $slug)->first();
        if (!$product) {
            abort(404);
        }

        $data['meta_title'] = $product->meta_title;
        $data['meta_keywords'] = $product->meta_keywords;
        $data['meta_description'] = $product->meta_description;
        return view('frontend.product.show', compact('product'), $data);
    }
}