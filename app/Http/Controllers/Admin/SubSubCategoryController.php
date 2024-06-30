<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Sub Sub Category';
        $sub_sub_categories = SubSubCategory::all();
        return view('admin.sub_sub_category.index', compact('sub_sub_categories'), $data);
    }

    public function getSubCategories($category_id)
    {
        $subCategories = SubCategory::where('category_id', $category_id)->get();
        return response()->json($subCategories);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Create Sub Sub Category';
        $categories = Category::get();
        $sub_categories = SubCategory::get();
        return view('admin.sub_sub_category.create', compact('categories', 'sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
        ]);
        $sub_sub_category = new SubSubCategory();
        $sub_sub_category->name = $validatedData['name'];
        $sub_sub_category->category_id = $validatedData['category_id'];
        $sub_sub_category->sub_category_id = $validatedData['sub_category_id'];
        $sub_sub_category->meta_title = $validatedData['meta_title'];
        $sub_sub_category->meta_keywords = $validatedData['meta_keywords'];
        $sub_sub_category->meta_description = $validatedData['meta_description'];
        $sub_sub_category->slug = Str::slug($validatedData['name']);
        $status = $request->has('status') ? true : false;
        $sub_sub_category->status = $status;

        $sub_sub_category->save();
        return redirect()->route('admin.sub_sub_category.index')->with('success', 'Create Sub Sub Category Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubSubCategory $subSubCategroy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['header_title'] = 'Edit Sub Sub Category';
        $categories = Category::get();
        $sub_categories = SubCategory::get();
        $sub_sub_category = SubSubCategory::find($id);
        return view('admin.sub_sub_category.edit', compact('sub_sub_category', 'categories', 'sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
        ]);
        $sub_sub_category = SubSubCategory::findOrFail($id);
        $sub_sub_category->name = $validatedData['name'];
        $sub_sub_category->category_id = $validatedData['category_id'];
        $sub_sub_category->sub_category_id = $validatedData['sub_category_id'];
        $sub_sub_category->meta_title = $validatedData['meta_title'];
        $sub_sub_category->meta_keywords = $validatedData['meta_keywords'];
        $sub_sub_category->meta_description = $validatedData['meta_description'];
        $sub_sub_category->slug = Str::slug($validatedData['name']);
        $status = $request->has('status') ? true : false;
        $sub_sub_category->status = $status;

        $sub_sub_category->save();

        return redirect()->route('admin.sub_sub_category.index')->with('success', 'Update Sub sub Category Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sub_sub_category = SubSubCategory::findOrFail($id);
        $sub_sub_category->delete();
        return redirect()->route('admin.sub_sub_category.index')->with('success', 'Deleted Sub sub Category Successfully');
    }
}