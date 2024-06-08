<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Category';
        $categories = Category::all();
        return view('admin.category.index', compact('categories'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Create Category';
        return view('admin.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable'
        ]);
        $category = new Category();
        $category->name = $validatedData['name'];
        $slug = Str::lower(str_replace('', '-', '', $validatedData['name']));
        $category->slug = $slug;
        $category->description = $validatedData['description'];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('admin/assets/images/category'), $imageName);
            $category->image = 'admin/assets/images/category/' . $imageName;
        }
        $status = $request->has('status') ? true : false;
        $category->status = $status;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
