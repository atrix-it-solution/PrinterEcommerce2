@extends('layouts.frontend.master')

@section('title', 'Search Results for "' . $query . '"')

@section('content')

<section class="shop_header py-5">
    <div class="container text-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-1">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search</li>
            </ol>
        </nav>
        <h1 class="mb-0 text-white">"{{ $query }}" | Search Result</h1>
        <p class="text-white mt-2">
            @if($type === 'all')
                Found {{ $allResults->total() }} result(s)
            @elseif($type === 'products')
                Found {{ $products->total() }} product(s)
            @elseif($type === 'blogs')
                Found {{ $blogs->total() }} blog post(s)
            @endif
        </p>
    </div>
</section>

<section class="blog_sec py-5">
    <div class="container py-lg-3">
        
        <!-- Search Filters -->
        <!-- <div class="row mb-4">
            <div class="col-12">
                <div class="search-filters d-flex gap-3 flex-wrap">
                    <a href="{{ route('search.results', ['q' => $query, 'type' => 'all']) }}" 
                       class="btn {{ $type === 'all' ? 'btn-dark' : 'btn-outline-dark' }}">
                        All Results
                    </a>
                    <a href="{{ route('search.results', ['q' => $query, 'type' => 'products']) }}" 
                       class="btn {{ $type === 'products' ? 'btn-dark' : 'btn-outline-dark' }}">
                        Products
                    </a>
                    <a href="{{ route('search.results', ['q' => $query, 'type' => 'blogs']) }}" 
                       class="btn {{ $type === 'blogs' ? 'btn-dark' : 'btn-outline-dark' }}">
                        Blog Posts
                    </a>
                </div>
            </div>
        </div> -->
        
        <!-- All Results (Mixed Products and Blogs) -->
        @if($type === 'all' && $allResults->count() > 0)
        <div class="row gx-lg-4">
            @foreach($allResults as $item)
            <div class="col-md-6 col-lg-4 my-3">
                <div class="blog_box h-100 d-flex flex-column overflow-hidden rounded-3 bg-white shadow-lg">
                    <a href="{{ $item['url'] }}" class="blog_img">
                        <img src="{{ $item['image'] }}" 
                             alt="{{ $item['title'] }}" 
                             class="img-fluid h-100 w-100 object-fit-cover" />
                    </a>
                    <div class="blog_content flex-grow-1 d-flex flex-column p-4">
                        <div class="blog_date pb-2 opacity-75">
                            {{ $item['created_at']->format('F d, Y') }}
                            <span class="badge bg-primary ms-2">{{ ucfirst($item['type']) }}</span>
                        </div>
                        <h4 class="fw-semibold">
                            <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                        </h4>
                       
                        
                        @if($item['type'] === 'product')
                        <!-- Product Price -->
                        <div class="product-price mb-3">
                            @if($item['sale_price'] && $item['sale_price'] < $item['regular_price'])
                                <span class="text-danger fw-bold h5">${{ number_format($item['sale_price'], 2) }}</span>
                                <span class="text-muted text-decoration-line-through ms-2">${{ number_format($item['regular_price'], 2) }}</span>
                            @else
                                <span class="fw-bold h5">${{ number_format($item['regular_price'], 2) }}</span>
                            @endif
                        </div>
                        @endif
                        
                        <div class="readmore mt-auto">
                            <a href="{{ $item['url'] }}" class="cusbtn">
                                {{ $item['type'] === 'product' ? 'Read More' : 'Read More' }} 
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Individual Type Results -->
        @if($type !== 'all')
            <!-- Products Only -->
            @if($type === 'products' && $products->count() > 0)
            <div class="row gx-lg-4">
                @foreach($products as $product)
                <div class="col-md-6 col-lg-4 my-3">
                    <div class="blog_box h-100 d-flex flex-column overflow-hidden rounded-3 bg-white shadow-lg">
                        <a href="{{ route('product.show', $product->slug) }}" class="blog_img">
                            <img src="{{ $product->featuredImage ? asset($product->featuredImage->url) : asset('assets/frontend/images/placeholder.jpg') }}" 
                                 alt="{{ $product->title }}" 
                                 class="img-fluid h-100 w-100 object-fit-cover" />
                        </a>
                        <div class="blog_content flex-grow-1 d-flex flex-column p-4">
                            <div class="blog_date pb-2 opacity-75">
                                {{ $product->created_at->format('F d, Y') }}
                            </div>
                            <h4 class="fw-semibold">
                                <a href="{{ route('product.show', $product->slug) }}">{{ $product->title }}</a>
                            </h4>
                          
                            
                            <!-- Product Price -->
                            <div class="product-price mb-3">
                                @if($product->sale_price && $product->sale_price < $product->regular_price)
                                    <span class="text-danger fw-bold h5">${{ number_format($product->sale_price, 2) }}</span>
                                    <span class="text-muted text-decoration-line-through ms-2">${{ number_format($product->regular_price, 2) }}</span>
                                @else
                                    <span class="fw-bold h5">${{ number_format($product->regular_price, 2) }}</span>
                                @endif
                            </div>
                            
                            <div class="readmore mt-auto">
                                <a href="{{ route('product.show', $product->slug) }}" class="cusbtn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Blogs Only -->
            @if($type === 'blogs' && $blogs->count() > 0)
            <div class="row gx-lg-4">
                @foreach($blogs as $blog)
                <div class="col-md-6 col-lg-4 my-3">
                    <div class="blog_box h-100 d-flex flex-column overflow-hidden rounded-3 bg-white shadow-lg">
                        <a href="{{ route('frontend.blog.single', $blog->slug) }}" class="blog_img">
                            <img src="{{ $blog->featuredImage ? asset($blog->featuredImage->url) : asset('assets/frontend/images/placeholder.jpg') }}" 
                                 alt="{{ $blog->title }}" 
                                 class="img-fluid h-100 w-100 object-fit-cover" />
                        </a>
                        <div class="blog_content flex-grow-1 d-flex flex-column p-4">
                            <div class="blog_date pb-2 opacity-75">
                                {{ $blog->created_at->format('F d, Y') }}
                            </div>
                            <h4 class="fw-semibold">
                                <a href="{{ route('frontend.blog.single', $blog->slug) }}">{{ $blog->title }}</a>
                            </h4>
                            
                            <div class="readmore mt-auto">
                                <a href="{{ route('frontend.blog.single', $blog->slug) }}" class="cusbtn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        @endif

        <!-- No Results Message -->
        @if(($type === 'all' && $allResults->count() === 0) || 
            ($type === 'products' && $products->count() === 0) || 
            ($type === 'blogs' && $blogs->count() === 0))
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="fa-solid fa-search fa-3x text-muted mb-3"></i>
                <h3>No results found</h3>
                <p class="text-muted">We couldn't find any {{ $type === 'all' ? 'results' : $type }} matching "{{ $query }}"</p>
                <div class="mt-4">
                    <a href="/shop" class="btn btn-dark me-3">Browse Products</a>
                    <a href="/blog" class="btn btn-outline-dark">Read Blog</a>
                </div>
            </div>
        </div>
        @endif

        <!-- Single Pagination -->
        @if(($type === 'all' && $allResults->hasPages()) || 
            ($type === 'products' && $products->hasPages()) || 
            ($type === 'blogs' && $blogs->hasPages()))
        <ul class="pagination cuspagination mt-4 pt-4 gap-1 justify-content-center">
            @php
                $paginator = $type === 'all' ? $allResults : ($type === 'products' ? $products : $blogs);
            @endphp

            {{-- Previous Page Link --}}
            @if($paginator->currentPage() > 1)
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </li>
            @else
                <li class="disabled"><a href="#"><i class="fa-solid fa-arrow-left"></i></a></li>
            @endif

            {{-- Pagination Elements --}}
            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();
            @endphp

            @if($lastPage > 0)
                {{-- First page --}}
                <li class="page_item {{ $currentPage == 1 ? 'active' : '' }}">
                    <a href="{{ $paginator->url(1) }}">1</a>
                </li>

                {{-- Show pages around current page --}}
                @for($i = max(2, $currentPage - 2); $i <= min($lastPage - 1, $currentPage + 2); $i++)
                    <li class="page_item {{ $currentPage == $i ? 'active' : '' }}">
                        <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Last page --}}
                @if($lastPage > 1)
                    @if($currentPage + 2 < $lastPage - 1)
                        <li class="page_item dots"><span>...</span></li>
                    @endif
                    <li class="page_item {{ $currentPage == $lastPage ? 'active' : '' }}">
                        <a href="{{ $paginator->url($lastPage) }}">{{ $lastPage }}</a>
                    </li>
                @endif
            @endif

            {{-- Next Page Link --}}
            @if($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>
            @else
                <li class="disabled"><a href="#"><i class="fa-solid fa-arrow-right"></i></a></li>
            @endif
        </ul>
        @endif

    </div>
</section>

<hr style="opacity: .1;">

<section class="features_sec py-5">
    <div class="container">
        <div class="row">
            <div class="col-6 col-xl-3 my-3">
                <div class="feature_box">
                    <div class="feature_icon">
                        <img src="{{ asset('assets/frontend/images/sicon1.svg') }}" alt="Complimentary Shipping" class="img-fluid" />
                    </div>
                    <h4>Complimentary Shipping</h4>
                    <p>Free worldwide shipping and returns - customs and duties taxes included.</p>
                </div>
            </div>
            <div class="col-6 col-xl-3 my-3">
                <div class="feature_box">
                    <div class="feature_icon">
                        <img src="{{ asset('assets/frontend/images/sicon2.svg') }}" alt="Customer service" class="img-fluid" />
                    </div>
                    <h4>Customer service</h4>
                    <p>We are available from Monday-Friday to answer your questions.</p>
                </div>
            </div>
            <div class="col-6 col-xl-3 my-3">
                <div class="feature_box">
                    <div class="feature_icon">
                        <img src="{{ asset('assets/frontend/images/sicon3.svg') }}" alt="Secure payment" class="img-fluid" />
                    </div>
                    <h4>Secure payment</h4>
                    <p>Your payment information is processed securely.</p>
                </div>
            </div>
            <div class="col-6 col-xl-3 my-3">
                <div class="feature_box">
                    <div class="feature_icon">
                        <img src="{{ asset('assets/frontend/images/sicon4.svg') }}" alt="Contact us" class="img-fluid" />
                    </div>
                    <h4>Contact us</h4>
                    <p>Need to contact us? Send us an e-mail at support@printhelp.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize wishlist functionality
    if (window.wishlistManager) {
        window.wishlistManager.refreshAllIcons();
    }
});
</script>
@endsection