@extends('frontend.layouts.master').
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">{{ $product->category->name }}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('frontend.product.list', [$product->category->slug, $product->sub_category->slug]) }}">{{ $product->sub_category->name }}</a>
                    </li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('frontend.product.list', [$product->category->slug, $product->sub_category->slug, $product->sub_sub_category->slug]) }}">{{ $product->sub_sub_category->name }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
                </ol>
            </div>
        </nav>
        <div class="page-content">
            <div class="container">
                <div class="product-details-top mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery">
                                <figure class="product-main-image">
                                    @if ($product->productImages->first())
                                        <img id="product-zoom" src="{{ $product->productImages->first()->getImage() }}"
                                            data-zoom-image="{{ $product->productImages->first()->getImage() }}"
                                            alt={{ $product->title }}>
                                    @else
                                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="{{ $product->title }}"
                                            class="product-image">
                                    @endif
                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure>
                                <div id="product-zoom-gallery" class="product-image-gallery">
                                    @if ($product->productImages->count())
                                        @foreach ($product->productImages as $images)
                                            <a class="product-gallery-item" href="#"
                                                data-image="{{ asset($images->image_name) }}"
                                                data-zoom-image="{{ asset($images->image_name) }}">
                                                <img src="{{ asset($images->image_name) }}" alt="product side">
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">{{ $product->title }}</h1>
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                    </div>
                                    <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                </div>
                                <div class="product-price">
                                    ৳ <span id="getTotalPrice">{{ $product->discount_price }}</span>
                                    <span
                                        class="product-price-text text-decoration-line-through">৳{{ $product->price }}</span>
                                </div>
                                <div class="product-content">
                                    <p>{!! $product->short_description !!}</p>
                                </div>
                                <form action="{{route('add_to_cart')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}" id="">
                                    @if ($product->productColors->count())
                                        <div class="details-filter-row details-row-size">
                                            <label for="color_id">Color:</label>
                                            <div class="select-custom">
                                                <select name="color_id" required id="color_id" class="form-control">
                                                    <option value="">Select a color</option>
                                                    @foreach ($product->productColors as $productColor)
                                                        <option value="{{ $productColor->color->id }}">
                                                            {{ $productColor->color->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($product->productSizes->count())
                                        <div class="details-filter-row details-row-size">
                                            <label for="size_id">Size:</label>
                                            <div class="select-custom">
                                                <select name="size_id" required id="size_id"
                                                    class="form-control getSizePrice">
                                                    <option data-price="0" value="">Select a size</option>
                                                    @foreach ($product->productSizes as $productSize)
                                                        <option
                                                            data-price="{{ !empty($productSize->price) ? $productSize->price : 0 }}"
                                                            value="{{ $productSize->id }}">
                                                            {{ $productSize->name }} @if (!empty($productSize->price))
                                                                (৳{{ $productSize->price }})
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="details-filter-row details-row-size">
                                        <label for="qty">Qty:</label>
                                        <div class="product-details-quantity">
                                            <input type="number" id="qty" class="form-control" value="1"
                                                min="1" max="10" step="1" name="qty" required
                                                data-decimals="0" required>
                                        </div>
                                    </div>
                                    <div class="product-details-action">
                                        {{-- <a href="#" class=""></a> --}}
                                        <button type="submit" class="btn-product btn-cart"
                                            style="background: none; color:#fcb941; font-size:16px">add to cart</button>

                                        <div class="details-action-wrapper">
                                            <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to
                                                    Wishlist</span></a>
                                            {{-- <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to
                                                Compare</span></a> --}}
                                        </div>
                                    </div>
                                </form>
                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span>Brand:</span>
                                        <a href="">{{ $product->brand->name }}</a>
                                    </div>
                                    {{-- <div class="social-icons social-icons-sm">
                                        <span class="social-label">Share:</span>
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                                class="icon-pinterest"></i></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-details-tab product-details-extended">
                <div class="container">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                                role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab"
                                role="tab" aria-controls="product-info-tab" aria-selected="false">Additional
                                information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-shipping-link" data-toggle="tab"
                                href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab"
                                aria-selected="false">Shipping & Returns</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab"
                                role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                        aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <div class="container">
                                {!! $product->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel"
                        aria-labelledby="product-info-link">
                        <div class="product-desc-content">
                            <div class="container">
                                {!! $product->additional_information !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                        aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <div class="container">
                                {!! $product->shipping_returns !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                        aria-labelledby="product-review-link">
                        <div class="reviews">
                            <div class="container">
                                <h3>Reviews (2)</h3>
                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">Samanta J.</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 80%;"></div>
                                                </div>
                                            </div>
                                            <span class="review-date">6 days ago</span>
                                        </div>
                                        <div class="col">
                                            <h4>Good, perfect size</h4>

                                            <div class="review-content">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum
                                                    dolores assumenda asperiores facilis porro reprehenderit animi culpa
                                                    atque blanditiis commodi perspiciatis doloremque, possimus, explicabo,
                                                    autem fugit beatae quae voluptas!</p>
                                            </div>

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">John Doe</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 100%;"></div>

                                                </div>
                                            </div>
                                            <span class="review-date">5 days ago</span>
                                        </div>
                                        <div class="col">
                                            <h4>Very good</h4>

                                            <div class="review-content">
                                                <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis
                                                    laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi,
                                                    quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                            </div>

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <h2 class="title text-center mb-4">You May Also Like</h2>
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="product product-7">
                            <figure class="product-media">
                                <span class="product-label label-new">New</span>
                                <a href="{{ route('frontend.product.show', $relatedProduct->slug) }}">
                                    <img src="{{ $relatedProduct->productImages->first()->getImage() }}"
                                        alt="{{ $relatedProduct->title }}" class="product-image">
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                            wishlist</span></a>
                                </div>
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                            </figure>
                            <div class="product-body">
                                <div class="product-cat">
                                    <a
                                        href="{{ route('frontend.product.list', [$relatedProduct->category->slug, $relatedProduct->sub_category->slug]) }}">{{ $relatedProduct->sub_category->name }}</a>
                                </div>
                                <h3 class="product-title"><a
                                        href="{{ route('frontend.product.show', $relatedProduct->slug) }}">{{ $relatedProduct->title }}</a>
                                </h3>
                                </h3>
                                <div class="product-price">
                                    ৳ {{ $relatedProduct->discount_price }}
                                    <span
                                        class="product-price-text text-decoration-line-through">৳{{ $relatedProduct->price }}</span>
                                </div>
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 20%;"></div>
                                    </div>
                                    <span class="ratings-text">( 2 Reviews )</span>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </main>
@endsection
@section('js')
    <script src="{{ asset('frontend/assets/js/jquery.elevateZoom.min.js') }}"></script>
    <script>
        $('.getSizePrice').change(function() {
            var product_price = '{{ $product->discount_price }}'
            var price = $('option:selected', this).attr('data-price');
            var total = parseFloat(product_price) + parseFloat(price);
            $('#getTotalPrice').html(total.toFixed(2))
        });
    </script>
@endsection
