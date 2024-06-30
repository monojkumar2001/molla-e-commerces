<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Brand';
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Create Brand';
        return view('admin.brand.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
        ]);
        $brand = new Brand();
        $brand->name = $validatedData['name'];
        $brand->slug = Str::slug($validatedData['name']);
        $brand->meta_title = $validatedData['meta_title'];
        $brand->meta_keywords = $validatedData['meta_keywords'];
        $brand->meta_description = $validatedData['meta_description'];

        $status = $request->has('status') ? true : false;
        $brand->status = $status;
        $brand->save();

        return redirect()->route('admin.brand.index')->with('success', 'Brand Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['header_title'] = 'Edit Category';
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'), $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
        ]);
        $brand = Brand::findOrFail($id);
        $brand->name = $validatedData['name'];
        $slug = Str::lower(str_replace('', '-', '', $validatedData['name']));
        $brand->slug = $slug;
        $brand->meta_title = $validatedData['meta_title'];
        $brand->meta_keywords = $validatedData['meta_keywords'];
        $brand->meta_description = $validatedData['meta_description'];

        $status = $request->has('status') ? true : false;
        $brand->status = $status;
        $brand->save();

        return redirect()->route('admin.brand.index')->with('success', 'Brand Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        $brand->delete();
        return redirect()->route('admin.brand.index')->with('success', 'Brand Deleted Successfully');
    }
}