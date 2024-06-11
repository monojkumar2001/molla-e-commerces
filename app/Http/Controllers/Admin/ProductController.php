<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Product';
        $products = Product::all();
        return view('admin.product.index', compact('products'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Create Product';
        $categories = Category::orderBy("created_at", "desc")->get();
        $sub_categories = SubCategory::orderBy("created_at", "desc")->get();
        $brands = Brand::orderBy("created_at", "desc")->get();
        return view('admin.product.create', compact('categories','sub_categories','brands'), $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_title' => 'required',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_id' => 'required',
            'image' => 'required',
            'price' => 'required',
            'old_price' => 'required',
            'stock_quantity' => 'required',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'additional_information' => 'nullable',
            'shipping_returns' => 'nullable',
        ]);

        $product = new Product();
        $product->product_title = $validatedData['product_title'];
        $product->slug = Str::lower(str_replace('', '-', '', $validatedData['product_title']));
        $product->meta_title = $validatedData['meta_title'];
        $product->meta_keywords = $validatedData['meta_keywords'];
        $product->meta_description = $validatedData['meta_description'];
        $product->category_id = $validatedData['category_id'];
        $product->sub_category_id = $validatedData['sub_category_id'];
        $product->brand_id = $validatedData['brand_id'];
        $product->price = $validatedData['price'];
        $product->old_price = $validatedData['old_price'];
        $product->stock_quantity = $validatedData['stock_quantity'];
        $product->short_description = $validatedData['short_description'];
        $product->description = $validatedData['description'];
        $product->additional_information = $validatedData['additional_information'];
        $product->shipping_returns = $validatedData['shipping_returns'];

        $images = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imageName = md5(uniqid()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/images/product'), $imageName);
                $images[] = 'admin/assets/images/product/' . $imageName;
            }
        }

        // Save the image paths in the database
        $product->image = json_encode($images);
        $product->status = $request->has('status') ? true : false;
        $product->save();

    }

    /**
     * Display the specified resource.
     */
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
