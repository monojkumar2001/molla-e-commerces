@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Category</h6>

                        <form action="{{ route('admin.sub_category.update', $sub_category->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" value="{{ $sub_category->name }}"
                                            id="name" name="name" autocomplete="off" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select id="category_id" name="category_id"
                                            class="js-example-basic-single form-control form-select" required>
                                            <option>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input id="image" class="form-control" name="image" type="file">
                                </div> --}}
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" type="text"id="tinymceExample" cols="30" rows="10">{{ $sub_category->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <label class="form-check-label" for="termsCheck">
                                            Active
                                        </label>
                                        <input type="checkbox" @if ($sub_category->status) checked @endif
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
