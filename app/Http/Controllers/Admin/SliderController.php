<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $data['header_title'] = 'slider';
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'), $data);
    }

    public function create()
    {
        $data['header_title'] = 'Create slider';
        return view('admin.slider.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'slider_short_title' => 'nullable',
            'slider_title' => 'nullable',
            'description' => 'nullable',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
            'image' => 'nullable'
        ]);
        $slider = new Slider();
        $slider->slider_short_title = $validatedData['slider_short_title'];
        $slider->slider_title = $validatedData['slider_title'];
        $slider->description = $validatedData['description'];
        $slider->meta_title = $validatedData['meta_title'];
        $slider->meta_keywords = $validatedData['meta_keywords'];
        $slider->meta_description = $validatedData['meta_description'];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('admin/assets/images/slider'), $imageName);
            $slider->image = 'admin/assets/images/slider/' . $imageName;
        }
        $status = $request->has('status') ? true : false;
        $slider->status = $status;
        $slider->save();

        return redirect()->route('admin.slider.index')->with('success', 'Slider Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['header_title'] = 'Edit slider';
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'), $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'slider_short_title' => 'nullable',
            'slider_title' => 'nullable',
            'description' => 'nullable',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
            'image' => 'nullable'
        ]);

        $slider = Slider::findOrFail($id);
        $slider->slider_short_title = $validatedData['slider_short_title'];
        $slider->slider_title = $validatedData['slider_title'];
        $slider->description = $validatedData['description'];
        $slider->meta_title = $validatedData['meta_title'];
        $slider->meta_keywords = $validatedData['meta_keywords'];
        $slider->meta_description = $validatedData['meta_description'];
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($slider->image) {
                $oldImagePath = public_path($slider->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save the new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('admin/assets/images/slider'), $imageName);
            $slider->image = 'admin/assets/images/slider/' . $imageName;
        }
        $status = $request->has('status') ? true : false;
        $slider->status = $status;
        $slider->save();

        return redirect()->route('admin.slider.index')->with('success', 'Slider Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if ($slider->image) {
            $oldImagePath = public_path($slider->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $slider->delete();
        return redirect()->route('admin.slider.index')->with('success', 'Slider Deleted Successfully');
    }
}
