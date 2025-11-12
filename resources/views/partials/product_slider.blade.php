 
 @foreach($products as $product)
<div>
    <div class="product_box">
        <div class="product_img">
            <a href="{{ route('product.show', $product->slug) }}" >
                @if($product->featuredImage)
                <img src="{{ asset($product->featuredImage->url) }}" alt="{{ $product->title }}" class="img-fluid" />
                <img src="{{ asset($product->featuredImage->url) }}" alt="{{ $product->title }}" class="img-fluid hover_img" />
            
                @endif
            </a>
            <div class="cart_btn">
                <button class="cusbtn cartbtn add-to-cart" 
                        data-product-id="{{ $product->id }}"
                        data-product-title="{{ $product->title }}"
                        data-product-price="{{ $product->sale_price ?? $product->regular_price }}"
                        data-product-image="{{ $product->featuredImage->url ?? 'assets/frontend/images/placeholder.jpg' }}"
                        data-product-slug="{{ $product->slug }}">
                    Add to cart
                </button>
            </div>
        </div>
        <div class="product_meta">
            @if($product->sale_price && $product->regular_price)
            @php
            $discount = (($product->regular_price - $product->sale_price) / $product->regular_price) * 100;
            @endphp
            <div class="discount_percent">-{{ round($discount) }}%</div>
            @endif
            <div class="wishlist">
                <span class="wishlist-toggle wishlist-btn" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-custom-class="custom-tooltip" 
                    data-bs-title="Add to Wishlist"
                    data-product-id="{{ $product->id }}"
                    data-product-title="{{ $product->title }}">
                    <i class="fa-regular fa-heart"></i>
                </span>
            </div>
        </div>
        <div class="product_content">
            <h4>
                <a href="{{ route('product.show', $product->slug) }}">
                    {{ $product->title }}
                </a>
            </h4>
            <div class="price">
                @if($product->sale_price && $product->regular_price)
                <del>${{ number_format($product->regular_price, 2) }}</del>
                <ins>${{ number_format($product->sale_price, 2) }}</ins>
                @else
                <ins>${{ number_format($product->regular_price, 2) }}</ins>
                @endif
            </div>
            <div class="rating">
                <span class="fa-solid fa-star"></span>
                <span class="fa-solid fa-star"></span>
                <span class="fa-solid fa-star"></span>
                <span class="fa-solid fa-star"></span>
                <span class="fa-regular fa-star"></span>
            </div>
        </div>
    </div>
</div>
@endforeach




