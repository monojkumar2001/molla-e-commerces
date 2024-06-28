<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\ProductColor;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getSubCategories($category_id)
    {
        $subCategories = SubCategory::where('category_id', $category_id)->get();
        return response()->json($subCategories);
    }

    public function getSubSubCategories($sub_category_id)
    {
        $subSubCategories = SubSubCategory::where('sub_category_id', $sub_category_id)->get();
        Log::info('Sub Sub Categories:', ['sub_category_id' => $sub_category_id, 'data' => $subSubCategories]);
        return response()->json($subSubCategories);
    }
    public function index()
    {
        $data['header_title'] = 'Product';
        $products = Product::with('variants')->get();
        return view('admin.product.index', compact('products'), $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Create Product';
        $categories = Category::orderBy("created_at", "desc")->get();
        $brands = Brand::orderBy("created_at", "desc")->get();
        $colors = Color::orderBy("created_at", "desc")->get();
        return view('admin.product.create', compact('categories', 'brands', 'colors'), $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'nullable',
            'sub_sub_category_id' => 'nullable',
            'brand_id' => 'required',
            'buy_price' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'stock_quantity' => 'required',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'additional_information' => 'nullable',
            'shipping_returns' => 'nullable',
            'color_id' => 'array|nullable',

        ]);

        $product = new Product();
        $product->title = $validatedData['title'];
        $product->slug = Str::slug($validatedData['title']);
        $product->category_id = $validatedData['category_id'];
        $product->sub_category_id = $validatedData['sub_category_id'];
        $product->sub_sub_category_id = $validatedData['sub_sub_category_id'];
        $product->brand_id = $validatedData['brand_id'];
        $product->buy_price = $validatedData['buy_price'];
        $product->price = $validatedData['price'];
        $product->discount_price = $validatedData['discount_price'];
        $product->stock_quantity = $validatedData['stock_quantity'];
        $product->meta_title = $validatedData['meta_title'];
        $product->meta_keywords = $validatedData['meta_keywords'];
        $product->meta_description = $validatedData['meta_description'];
        $product->short_description = $validatedData['short_description'];
        $product->description = $validatedData['description'];
        $product->additional_information = $validatedData['additional_information'];
        $product->shipping_returns = $validatedData['shipping_returns'];
        $product->status = $request->has('status') ? true : false;
        $product->save();

        if (!empty($validatedData['color_id'])) {
            foreach ($validatedData['color_id'] as $color_id) {
                $color = new ProductColor();
                $color->color_id = $color_id;
                $color->product_id = $product->id;
                $color->save();
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */

    public function getVariantPrice(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'color' => 'nullable',
            'size' => 'nullable'
        ]);

        $variant = ProductVariant::where('product_id', $validatedData['product_id'])
            ->where('color', $validatedData['color'])
            ->where('size', $validatedData['size'])
            ->first();

        if ($variant) {
            return response()->json(['price' => $variant->price], 200);
        } else {
            return response()->json(['price' => 'N/A'], 200);
        }
    }

    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}