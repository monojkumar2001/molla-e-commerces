<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $data['header_title'] = 'Category';
        $categories = Category::all();
        return view('admin.category.index', compact('categories'), $data);
    }

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
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
            'image' => 'nullable'
        ]);
        $category = new Category();
        $category->name = $validatedData['name'];
        $slug = Str::lower(str_replace('', '-', '', $validatedData['name']));
        $category->slug = $slug;
        $category->description = $validatedData['description'];
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keywords = $validatedData['meta_keywords'];
        $category->meta_description = $validatedData['meta_description'];
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
    public function edit($id)
    {
        $data['header_title'] = 'Edit Category';
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'), $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
            'image' => 'nullable'
        ]);

        $category = Category::findOrFail($id);
        $category->name = $validatedData['name'];


        $category->description = $validatedData['description'];
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keywords = $validatedData['meta_keywords'];
        $category->meta_description = $validatedData['meta_description'];
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image) {
                $oldImagePath = public_path($category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save the new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('admin/assets/images/category'), $imageName);
            $category->image = 'admin/assets/images/category/' . $imageName;
        }
        $slug = Str::lower(str_replace('', '-', '', $validatedData['name']));
        $category->slug = $slug;
        $status = $request->has('status') ? true : false;
        $category->status = $status;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image) {
            $oldImagePath = public_path($category->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category Deleted Successfully');
    }
}
