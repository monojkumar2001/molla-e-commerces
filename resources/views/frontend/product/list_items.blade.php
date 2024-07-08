@foreach ($products as $product)
    <div class="col-12 col-md-4 col-lg-4">
        <div class="product product-7 text-center">
            <figure class="product-media">
                <span class="product-label label-new">New</span>
                @if ($product->productImages->first())
                    <img src="{{ $product->productImages->first()->getImage() }}" alt="{{ $product->title }}"
                        class="product-image">
                @else
                    <img src="{{ asset('path/to/default/image.jpg') }}" alt="{{ $product->title }}" class="product-image">
                @endif
                <div class="product-action-vertical">
                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                            wishlist</span></a>
                </div>
            </figure>
            <div class="product-body">
                <div class="product-cat">
                    <a
                        href="{{ route('frontend.product.list', ['category' => $category->slug]) }}">{{ $product->category->name }}</a>
                </div>
                <h3 class="product-title"><a
                        href="{{ route('frontend.product.show', $product->slug) }}">{{ $product->title }}</a>
                </h3>
                <div class="product-price">
                    ৳ {{ $product->discount_price }}
                    <span class="product-price-text text-decoration-line-through">৳{{ $product->price }}</span>
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
