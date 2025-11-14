    <!-- Products will be loaded here via AJAX -->

    <div class="productlist row gy-4">
        @foreach($products as $product)
        <div class="col-lg-4 col-6">
            <div class="product_box">
                
                    <a href="/product/{{ $product->slug }}" class="product_img">
                        @if($product->featuredImage)
                            <img src="{{ asset($product->featuredImage->url) }}" alt="{{ $product->title }}" class="img-fluid" />
                            <img src="{{ asset($product->featuredImage->url) }}" alt="{{ $product->title }}" class="img-fluid hover_img" />
                        @endif
                   
                    <div class="cart_btn">
                        <button class="cusbtn cartbtn " >
                                
                            view
                        </button>
                    </div>
                     </a>
               
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
                    <h4><a href="/product/{{ $product->slug }}">{{ $product->title }}</a></h4>
                    <div class="price">
                        @if($product->sale_price && $product->regular_price)
                            <del>₹{{ number_format($product->regular_price, 2) }}</del>
                            <ins>₹{{ number_format($product->sale_price, 2) }}</ins>
                        @else
                            <ins>₹{{ number_format($product->regular_price, 2) }}</ins>
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
</div>

    <!-- Initial Pagination -->
    @if($products->hasPages())
    <div id="initialPagination">
        <ul class="pagination cuspagination mt-4 pt-3 gap-1 justify-content-center">
            {{-- Previous Page Link --}}
            @if($products->onFirstPage())
                <li class="disabled"><span><i class="fa-solid fa-arrow-left"></i></span></li>
            @else
                <li><a href="{{ $products->previousPageUrl() }}"><i class="fa-solid fa-arrow-left"></i></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                @if($page == $products->currentPage())
                    <li class="page_item active"><span>{{ $page }}</span></li>
                @else
                    <li class="page_item"><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if($products->hasMorePages())
                <li><a href="{{ $products->nextPageUrl() }}"><i class="fa-solid fa-arrow-right"></i></a></li>
            @else
                <li class="disabled"><span><i class="fa-solid fa-arrow-right"></i></span></li>
            @endif
        </ul>
    </div>
    @endif
<script src="{{ asset('assets/frontend/js/wishlist.js') }}"></script>


