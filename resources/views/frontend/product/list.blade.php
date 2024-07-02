@extends('frontend.layouts.master')
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
                                        <select name="sortby" id="sortby" class="form-control">
                                            <option value="popularity" selected="selected">Most Popular</option>
                                            <option value="rating">Most Rated</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="products mb-3">
                            <div class="row justify-content-center">
                                @foreach ($products as $product)
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                <span class="product-label label-new">New</span>
                                                <a href="{{ route('frontend.product.show', $product->slug) }}">
                                                    <img src="{{ $product->productImages->first()->getImage() }}"
                                                        alt="{{ $product->title }}" class="product-image">

                                                </a>
                                                <div class="product-action-vertical">
                                                    <a href="#"
                                                        class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                            wishlist</span></a>
                                                </div>
                                            </figure>
                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a
                                                        href="{{ route('frontend.product.list', ['category' => $category->slug]) }}">{{ $product->category->name }}</a>
                                                </div>
                                                <h3 class="product-title"><a
                                                        href="{{ route('frontend.product.show', $product->slug) }}">{{ $product->product_title }}</a>
                                                </h3>
                                                <div class="product-price">
                                                    ৳ {{ $product->discount_price }}
                                                    <span
                                                        class="product-price-text text-decoration-line-through">৳{{ $product->price }}</span>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 20%;"></div>
                                                    </div>
                                                    <span class="ratings-text">( 2 Reviews )</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                        </div>

                        @if ($products->isEmpty())
                            <span class=" text-center d-flex justify-content-center">Product not found</span>
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

                    </div><!-- End .col-lg-9 -->
                    @include('frontend.components.sidebar')
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
