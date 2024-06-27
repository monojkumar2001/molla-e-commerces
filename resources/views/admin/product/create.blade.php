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
                                                class='text-danger'>*</span></label>
                                        <input type="text" class="form-control" id="product_title" name="product_title"
                                            autocomplete="off" placeholder="Enter product title">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category <span
                                                class='text-danger'>*</span></label>
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
                                                class='text-danger'>*</span></label>
                                        {{-- <select id="sub_category_id" name="sub_category_id"
                                            class="js-example-basic-single form-control form-select" required>
                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                            @endforeach
                                        </select> --}}
                                        <select id="sub_category_id" name="sub_category_id" class="form-control form-select" required>
                                            <option value="">Select Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="brand_id" class="form-label">Brand <span
                                                class='text-danger'>*</span></label>
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
                                        <label for="stock_quantity" class="form-label">Color <span
                                                class='text-danger'>*</span></label>
                                        <div class="form-group">
                                            <label for="">
                                                <input type="checkbox" name="color_id[]" id="">
                                                Red
                                            </label>
                                            <label for="">
                                                <input type="checkbox" name="color_id[]" id="">
                                                White
                                            </label>
                                            <label for="">
                                                <input type="checkbox" name="color_id[]" id="">
                                                Red
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">

                                        <div class="form-group">
                                            <label for="stock_quantity" class="form-label">Size <span
                                                    class='text-danger'>*</span></label>
                                            <div>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Price</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" class=" form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" class=" form-control">
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-success" type="button">Add</button>
                                                                <button class="btn btn-danger"
                                                                    type="button">Delete</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="stock_quantity" class="form-label">Stock Quantity <span
                                                class='text-danger'>*</span></label>
                                        <input type="number" class="form-control" id="stock_quantity" name="stock_quantity"
                                            autocomplete="off" placeholder="Enter stock quantity">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Product Image <span
                                                class='text-danger'>*</span></label>
                                        <input type="file" id='image' name="image[]"
                                            onchange="previewImages(event)" multiple class="form-control" required>
                                    </div>

                                    <div id="imagePreview" class="mb-3"></div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price <span
                                                class='text-danger'>*</span></label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            autocomplete="off" placeholder="Enter Price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="old_price" class="form-label">Old Price <span
                                                class='text-danger'>*</span></label>
                                        <input type="number" class="form-control" id="old_price" name="old_price"
                                            autocomplete="off" placeholder="Enter old price">
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
                                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords"
                                            name="meta_keywords" autocomplete="off" placeholder="Enter meta keywords">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="meta_description" class="form-label">Meta Description</label>
                                        <textarea class="form-control" name="meta_description" id="tinymceExample" cols="30" rows="7"></textarea>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_description" id="tinymceExample" cols="30" rows="6"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="tinymceExample" cols="30" rows="10"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="additional_information" class="form-label">Additional Information</label>
                                    <textarea class="form-control" name="additional_information" id="tinymceExample" cols="30" rows="10"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="shipping_returns" class="form-label">Shipping Returns</label>
                                    <textarea class="form-control" name="shipping_returns" id="tinymceExample" cols="30" rows="10"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Product Variant</label>
                                    <div id="variants">
                                        <div class="variant">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="variants[0][color]" class="form-label">Color</label>
                                                        <input type="text" id="variants[0][color]"
                                                            class="form-control" name="variants[0][color]"
                                                            placeholder="Color">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="variants[0][size]" class="form-label">Size</label>
                                                        <input type="text" id="variants[0][size]" class="form-control"
                                                            name="variants[0][size]" placeholder="Size">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="variants[0][price]" class="form-label">Price</label>
                                                        <input type="text" id="variants[0][price]"
                                                            class="form-control" name="variants[0][price]"
                                                            placeholder="Price">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="variants[0][stock_quantity]" class="form-label">Stock
                                                            Quantity</label>
                                                        <input type="text" id="variants[0][stock_quantity]"
                                                            class="form-control" name="variants[0][stock_quantity]"
                                                            placeholder="Stock Quantity">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="addVariant()">Add
                                        Variant</button>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <label class="form-check-label" for="termsCheck">Active</label>
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
    <script>
        let variantIndex = 1;

        function addVariant() {
            const variantDiv = document.createElement('div');
            variantDiv.className = 'variant';
            variantDiv.innerHTML = `
        <div class="row">
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="variants[${variantIndex}][color]" class="form-label">Color</label>
                    <input type="text" id="variants[${variantIndex}][color]" class="form-control" name="variants[${variantIndex}][color]" placeholder="Color">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="variants[${variantIndex}][size]" class="form-label">Size</label>
                    <input type="text" id="variants[${variantIndex}][size]" class="form-control" name="variants[${variantIndex}][size]" placeholder="Size">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="variants[${variantIndex}][price]" class="form-label">Price</label>
                    <input type="text" id="variants[${variantIndex}][price]" class="form-control" name="variants[${variantIndex}][price]" placeholder="Price">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="variants[${variantIndex}][stock_quantity]" class="form-label">Stock Quantity</label>
                    <input type="text" id="variants[${variantIndex}][stock_quantity]" class="form-control" name="variants[${variantIndex}][stock_quantity]" placeholder="Stock Quantity">
                </div>
            </div>
        </div>
    `;
            document.getElementById('variants').appendChild(variantDiv);
            variantIndex++;
        }
    </script>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category_id').change(function() {
                let categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/admin/product/subcategories/' + categoryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data); // Debugging line
                            $('#sub_category_id').empty();
                            $('#sub_category_id').append('<option value="">Select Sub Category</option>');
                            $.each(data, function(key, value) {
                                $('#sub_category_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", error); // Debugging line
                            console.error("Status:", status);
                            console.error("Response:", xhr.responseText);
                        }
                    });
                } else {
                    $('#sub_category_id').empty();
                    $('#sub_category_id').append('<option value="">Select Sub Category</option>');
                }
            });
        });
    </script>
@endsection
