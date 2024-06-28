@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Sub Sub Category</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Create Sub Sub Category</h6>

                        <form action="{{ route('admin.sub_sub_category.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @include('admin.layouts.message')
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            autocomplete="off" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category <span
                                            class='text-danger'>*</span></label>
                                        <select id="category_id" name="category_id" class=" form-control form-select-lg"
                                            required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sub_category_id" class="form-label">Sub Category <span
                                            class='text-danger'>*</span></label>
                                        <select id="sub_category_id" name="sub_category_id"
                                            class="form-control form-select-lg" required>
                                            <option value="">Select Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                            autocomplete="off" placeholder="Enter Meta Title">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="meta_keywords" class="form-label">meta_keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                            autocomplete="off" placeholder="Enter meta keywords">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea class="form-control" name="meta_description" type="text"id="tinymceExample" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <label class="form-check-label" for="termsCheck">
                                            Active
                                        </label>
                                        <input type="checkbox" class="form-check-input" checked name="status"
                                            id="termsCheck">
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
        });
    </script>
@endsection
