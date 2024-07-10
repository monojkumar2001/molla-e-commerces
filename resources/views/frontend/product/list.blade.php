@extends('frontend.layouts.master')
@section('style')
    <style type="text/css">
        .active-color {
            border: 3px solid #000 !important;
        }
    </style>
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center"
            style="background-image: url('{{ asset('frontend/assets/images/page-header-bg.jpg') }}')">
            <div class="container">
                @if (!empty($sub_sub_category))
                    <h1 class="page-title">{{ $sub_sub_category->name }}</h1>
                @elseif (!empty($sub_category))
                    <h1 class="page-title">{{ $sub_category->name }}</h1>
                @else
                    <h1 class="page-title">{{ $category->name }}</h1>
                @endif
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>
                    @if (!empty($sub_sub_category))
                        <li class="breadcrumb-item"><a
                                href="{{ route('frontend.product.list', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('frontend.product.list', ['category' => $category->slug, 'subcategory' => $sub_category->slug]) }}">{{ $sub_category->name }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $sub_sub_category->name }}</li>
                    @elseif (!empty($sub_category))
                        <li class="breadcrumb-item"><a
                                href="{{ route('frontend.product.list', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $sub_category->name }}</li>
                    @else
                        <li class="breadcrumb-item active">{{ $category->name }}</li>
                    @endif
                </ol>
            </div>
        </nav>
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    Showing <span>9 of 56</span> Products
                                </div>
                            </div>
                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">Sort by:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control ChangeSortBy">
                                            <option value="">Select</option>
                                            <option value="popularity">Most Popular</option>
                                            <option value="rating">Most Rated</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="products mb-3">
                            <div class="row justify-content-center" id="product-list">
                                @include('frontend.product.list_items', ['products' => $products])
                            </div>


                        </div>
                        @if ($products->isEmpty())
                            <span class=" text-center d-flex justify-content-center"></span>
                        @else
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    @if ($products->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true">
                                            <a class="page-link page-link-prev" href="javascript:;" aria-label="Previous"
                                                tabindex="-1" aria-disabled="true">
                                                <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link page-link-prev" href="{{ $products->previousPageUrl() }}"
                                                aria-label="Previous" tabindex="-1" aria-disabled="true">
                                                <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                            </a>
                                        </li>
                                    @endif
                                    @foreach ($products as $product)
                                        <li
                                            class="page-item {{ $products->currentPage() == $loop->iteration ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $product->url }}">{{ $loop->iteration }}</a>
                                        </li>
                                    @endforeach
                                    <li class="page-item-total">of {{ $products->lastPage() }}</li>
                                    @if ($products->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link page-link-next" href="{{ $products->nextPageUrl() }}"
                                                aria-label="Next">
                                                Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled" aria-disabled="true">
                                            <a class="page-link page-link-next" href="javascript:;" aria-label="Next">
                                                Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>
                    <aside class="col-lg-3 order-lg-first">
                        <form action="{{ url('get_filter_product') }}" method="POST" id="FilterForm">
                            @csrf
                            <input type="hidden" name="sub_category_id" id="get_sub_category_id">
                            <input type="hidden" name="brand_id" id="get_brand_id">
                            <input type="hidden" name="color_id" id="get_color_id">
                            <input type="hidden" name="sort_by_id" id="get_sort_by_id">
                            <input type="text" name="start_price" id="get_start_price">
                            <input type="text" name="end_price" id="get_end_price">
                        </form>
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                                <a href="#" class="sidebar-filter-clear">Clean All</a>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                        aria-controls="widget-1">
                                        Category
                                    </a>
                                </h3>
                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            @if (!empty($category))
                                                @foreach ($category->subCategories as $subCategory)
                                                    <div class="filter-item">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                class="custom-control-input ChangeCategory"
                                                                value="{{ $subCategory->id }}"
                                                                id="cat-{{ $subCategory->id }}">
                                                            <label class="custom-control-label"
                                                                for="cat-{{ $subCategory->id }}">{{ $subCategory->name }}</label>
                                                        </div>
                                                        <span class="item-count">{{ $subCategory->TotalProduct() }}</span>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true"
                                        aria-controls="widget-2">
                                        Size
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-2">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-1">
                                                    <label class="custom-control-label" for="size-1">XS</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-2">
                                                    <label class="custom-control-label" for="size-2">S</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked
                                                        id="size-3">
                                                    <label class="custom-control-label" for="size-3">M</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked
                                                        id="size-4">
                                                    <label class="custom-control-label" for="size-4">L</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-5">
                                                    <label class="custom-control-label" for="size-5">XL</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-6">
                                                    <label class="custom-control-label" for="size-6">XXL</label>
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->
                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">`
                                    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true"
                                        aria-controls="widget-3">
                                        Colour
                                    </a>
                                </h3>
                                <div class="collapse show" id="widget-3">
                                    <div class="widget-body">
                                        <div class="filter-colors">
                                            @foreach ($colors as $color)
                                                <a href="javascrpit:;" class="ChangeColor" data-val="0"
                                                    id="{{ $color->id }}"
                                                    style="background: {{ $color->code }};"><span
                                                        class="sr-only">{{ $color->name }}</span></a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"
                                        aria-controls="widget-4">
                                        Brand
                                    </a>
                                </h3>
                                <div class="collapse show" id="widget-4">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            @foreach ($brands as $brand)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input ChangeBrand"
                                                            id="brand-{{ $brand->id }}" value="{{ $brand->id }}">
                                                        <label class="custom-control-label"
                                                            for="brand-{{ $brand->id }}">{{ $brand->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                        aria-controls="widget-5">
                                        Price
                                    </a>
                                </h3>
                                <div class="collapse show" id="widget-5">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                Price Range:
                                                <span id="filter-price-range"></span>
                                            </div>
                                            <div id="price-slider"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        var xhr = null;

        function FilterForm() {
            if (xhr !== null && xhr.readyState !== 4) {
                xhr.abort();
            }
            xhr = $.ajax({
                type: "POST",
                url: "{{ url('get_filter_product') }}",
                data: $('#FilterForm').serialize(),
                beforeSend: function() {
                    $('#product-list').html('<div>Loading...</div>');
                },
                success: function(response) {
                    $('#product-list').html(response.html);
                },
                error: function() {
                    $('#product-list').html('<div>Error loading products. Please try again.</div>');
                }
            });
        }

        $('.ChangeSortBy').change(function() {
            var id = $(this).val();
            $('#get_sort_by_id').val(id);
            FilterForm();
        })
        $('.ChangeCategory').change(function() {
            var ids = '';
            $('.ChangeCategory').each(function() {

                if (this.checked) {
                    var id = $(this).val();
                    ids += id + ',';
                }
            })
            $('#get_sub_category_id').val(ids);
            FilterForm();
        })
        $('.ChangeBrand').change(function() {
            var ids = '';
            $('.ChangeBrand').each(function() {

                if (this.checked) {
                    var id = $(this).val();
                    ids += id + ',';
                }
            })
            $('#get_brand_id').val(ids);
            FilterForm();
        })
        $('.ChangeColor').click(function() {
            var id = $(this).attr('id');
            var status = $(this).attr('data-val');
            if (status == 0) {
                $(this).attr('data-val', 1);
                $(this).addClass('active-color');
            } else {
                $(this).attr('data-val', 0);
                $(this).removeClass('active-color');
            }
            var ids = '';
            $('.ChangeColor').each(function() {
                var status = $(this).attr('data-val');
                if (status == 1) {
                    var id = $(this).attr('id');
                    ids += id + ',';
                }
            })
            $('#get_color_id').val(ids);
            FilterForm();
        })

        priceId = 0;
        if (typeof noUiSlider === 'object') {
            var priceSlider = document.getElementById('price-slider');
            noUiSlider.create(priceSlider, {
                start: [0, 100],
                connect: true,
                step: 50,
                margin: 50,
                range: {
                    'min': 0,
                    'max': 1000
                },
                tooltips: true,
                format: wNumb({
                    decimals: 0,
                    prefix: '৳'
                })
            });
            priceSlider.noUiSlider.on('update', function(values, handle) {
                console.log(values);
                var start_price = values[0];
                var end_price = values[1];
                $('#get_start_price').val(start_price);
                $('#get_end_price').val(end_price);
                if (priceId == 0 || priceId == 1) {
                    priceId++;
                } else {
                    FilterForm();
                }
            });
        }
    </script>
@endsection
