@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Product</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Create Product</h6>

                        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="product_title" class="form-label">Product Title <span
                                                class=' text-danger'>*</span></label>
                                        <input type="text" class="form-control" id="product_title" name="product_title"
                                            autocomplete="off" placeholder="Enter product title">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="meta_title" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                            autocomplete="off" placeholder="Enter Meta Title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="meta_keywords" class="form-label">meta_keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                            autocomplete="off" placeholder="Enter meta keywords">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea class="form-control" name="meta_description" type="text"id="tinymceExample" cols="30" rows="7"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category <span
                                                class=' text-danger'>*</span></label>
                                        <select id="category_id" name="category_id"
                                            class="js-example-basic-single form-control form-select" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sub_category_id" class="form-label">Sub Category <span
                                                class=' text-danger'>*</span></label>
                                        <select id="sub_category_id" name="sub_category_id"
                                            class="js-example-basic-single form-control form-select" required>
                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="brand_id" class="form-label">Brand <span
                                                class=' text-danger'>*</span></label>
                                        <select id="brand_id" name="brand_id"
                                            class="js-example-basic-single form-control form-select" required>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="stock_quantity" class="form-label">Stock Quantity <span
                                                class=' text-danger'>*</span></label>
                                        <input type="numnber" class="form-control" id="stock_quantity" name="stock_quantity"
                                            autocomplete="off" placeholder="Enter stock quantity">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Product Image <span
                                                class=' text-danger'>*</span></label>
                                        <input type="file" id='image' name="image[]"
                                            onchange="previewImages(event)" multiple class="form-control" required>
                                    </div>

                                    <div id="imagePreview" class="mb-3"></div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price <span
                                                class=' text-danger'>*</span></label>
                                        <input type="numnber" class="form-control" id="price" name="price"
                                            autocomplete="off" placeholder="Enter Price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="old_price" class="form-label">Old Price <span
                                                class='text-danger'>*</span></label>
                                        <input type="numnber" class="form-control" id="old_price" name="old_price"
                                            autocomplete="off" placeholder="Enter old price">
                                    </div>
                                </div>



                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_description" type="text"id="tinymceExample" cols="30"
                                        rows="6"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" type="text"id="tinymceExample" cols="30" rows="10"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="additional_information" class="form-label">Additional Information</label>
                                    <textarea class="form-control" name="additional_information" type="text"id="tinymceExample" cols="30"
                                        rows="10"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="shipping_returns" class="form-label">Shipping Returns</label>
                                    <textarea class="form-control" name="shipping_returns" type="text"id="tinymceExample" cols="30"
                                        rows="10"></textarea>
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
        function previewImages(event) {
            let files = event.target.files;
            document.getElementById('imagePreview').innerHTML = '';
            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.width = 100;
                    img.height = 100;
                    document.getElementById('imagePreview').appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
