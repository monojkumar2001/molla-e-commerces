@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Slider</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Slider</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Slider</h6>

                        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
    
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="slider_title" class="form-label">Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $slider->slider_title }}"
                                            id="slider_title" name="slider_title" autocomplete="off"
                                            placeholder="Enter Title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="slider_short_title" class="form-label">Short Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="slider_short_title"
                                            name="slider_short_title" value="{{ $slider->slider_short_title }}"
                                            autocomplete="off" placeholder="Enter short title">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" placeholder="Description" name="description" type="text"id="tinymceExample" cols="30" rows="10">{{ $slider->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" value="{{ $slider->meta_title }}"
                                            id="meta_title" name="meta_title" autocomplete="off"
                                            placeholder="Enter Meta Title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control" value="{{ $slider->meta_keywords }}"
                                            id="meta_keywords" name="meta_keywords" autocomplete="off"
                                            placeholder="Enter meta keywords">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input id="image" class="form-control" name="image" type="file">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea class="form-control" placeholder="Meta Description " name="meta_description" type="text"id="tinymceExample" cols="30" rows="10">{{ $slider->meta_description }}</textarea>
                                    </div>
                                </div>






                                <div class="mb-3">
                                    <div class="form-check">
                                        <label class="form-check-label" for="termsCheck">
                                            Active
                                        </label>
                                        <input type="checkbox" @if ($slider->status) checked @endif
                                            class="form-check-input" checked name="status" id="termsCheck">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
