@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Sub Category</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Sub Sub Category</h6>
                        <form action="{{ route('admin.sub_sub_category.update', $sub_sub_category->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $sub_sub_category->name }}"
                                            id="name" name="name" autocomplete="off" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category <span
                                                class='text-danger'>*</span></label>
                                        <select id="category_id" name="category_id" class="form-control form-select"
                                            required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $sub_sub_category->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sub_category_id" class="form-label">Sub Category <span
                                                class='text-danger'>*</span></label>
                                        <select id="sub_category_id" name="sub_category_id"
                                            class=" form-control form-select" required>
                                            <option value="">Select Sub Category</option>
                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}"
                                                    {{ $sub_category->id == $sub_sub_category->sub_category_id ? 'selected' : '' }}>
                                                    {{ $sub_category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control"
                                            value="{{ $sub_sub_category->meta_title }}" id="meta_title" name="meta_title"
                                            autocomplete="off" placeholder="Enter Meta Title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control"
                                            value="{{ $sub_sub_category->meta_keywords }}" id="meta_keywords"
                                            name="meta_keywords" autocomplete="off" placeholder="Enter Meta Keywords">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea class="form-control" name="meta_description" id="tinymceExample" cols="30" rows="10">{{ $sub_sub_category->meta_description }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <label class="form-check-label" for="statusCheck">
                                            Active
                                        </label>
                                        <input type="checkbox" class="form-check-input" name="status" id="statusCheck"
                                            @if ($sub_sub_category->status) checked @endif>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category_id');
            const subCategorySelect = document.getElementById('sub_category_id');

            categorySelect.addEventListener('change', function() {
                const categoryId = this.value;
                fetch(`{{ url('/admin/get-sub-categories') }}/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Debugging line
                        subCategorySelect.innerHTML = '<option value="">Select Sub Category</option>';
                        data.forEach(subCategory => {
                            subCategorySelect.innerHTML +=
                                `<option value="${subCategory.id}">${subCategory.name}</option>`;
                        });
                    })
                    .catch(error => console.error('Error fetching sub-categories:', error));
            });

            if (categorySelect.value) {
                categorySelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection
