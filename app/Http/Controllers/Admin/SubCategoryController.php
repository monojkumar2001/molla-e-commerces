<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Sub Category';
        $sub_categories = SubCategory::all();
        return view('admin.sub_category.index', compact('sub_categories'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Create Sub Category';
        $categories = Category::orderBy("created_at", "desc")->get();
        return view('admin.sub_category.create', compact('categories'), $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
        ]);

        $sub_category = new SubCategory();
        $sub_category->name = $validatedData['name'];
        $sub_category->category_id = $validatedData['category_id'];
        $sub_category->meta_title = $validatedData['meta_title'];
        $sub_category->meta_keywords = $validatedData['meta_keywords'];
        $sub_category->meta_description = $validatedData['meta_description'];
       
        $slug = Str::lower(str_replace('', '-', '', $validatedData['name']));
        $sub_category->slug = $slug;
        $status = $request->has('status') ? true : false;
        $sub_category->status = $status;
        $sub_category->save();
        return redirect()->route('admin.sub_category.index')->with('success', 'Create Sub Category Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
        $data['header_title'] = 'Edit Sub Category';
        $sub_category = SubCategory::find($id);
        $categories = Category::orderBy("created_at", "desc")->get();
        return view('admin.sub_category.edit', compact('sub_category','categories'), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
        ]);

        $sub_category = SubCategory::findOrFail($id);
        $sub_category->name = $validatedData['name'];
        $sub_category->category_id = $validatedData['category_id'];
        $sub_category->meta_title = $validatedData['meta_title'];
        $sub_category->meta_keywords = $validatedData['meta_keywords'];
        $sub_category->meta_description = $validatedData['meta_description'];

        
        $slug = Str::lower(str_replace('', '-', '', $validatedData['name']));
        $sub_category->slug = $slug;
        $status = $request->has('status') ? true : false;
        $sub_category->status = $status;
        $sub_category->save();
        return redirect()->route('admin.sub_category.index')->with('success', 'Update Sub Category Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $sub_category->delete();
        return redirect()->route('admin.sub_category.index')->with('success', 'Sub Category Deleted Successfully');
    }
}
