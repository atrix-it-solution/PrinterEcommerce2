@extends('layouts.frontend.master')

@section('title', 'Shop')

@section('content')
<div class="bodyWrapper ">
    <section class="shop_header py-5">
        <div class="container text-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-1">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                </ol>
            </nav>
            <h1 class="mb-0 text-white">Our Products</h1>
        </div>
    </section>
    
    <section class="shop_sec py-5">
        <div class="container py-lg-3">
        
            <div class="row gx-lg-5">
                <div class="col-lg-3">
                    <div id="filterForm">
                        <div class="filter pb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-normal">Filter</h5>
                                <a href="/shop" id="clearAll" class="clearAll small text-decoration-underline">Clear all</a>
                                
                            </div>

                            <div class="selected_items pt-1" id="activeFilters">
                                <!-- Active filters will appear here -->
                            </div>
                        </div>

                        <div class="filter_inner">
                            <!-- Categories Filter -->
                            <div class="filter_box">
                                <h6 class="filter_name">Categories</h6>
                                <ul class="cuschecbox filter_list" id="categoryFilter">
                                      @if(isset($categories) && $categories->count() > 0)
                                        @foreach($categories as $index => $category)
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="cat{{ $category->id }}" 
                                                        class="filter-checkbox" 
                                                        data-type="category" 
                                                        value="{{ $category->id }}" 
                                                        {{ in_array($category->id, request('category', [])) ? 'checked' : '' }} />
                                                <label for="cat{{ $category->id }}">
                                                    {{ $category->title }} <span>({{ $category->products_count }})</span>
                                                </label>
                                            </div>
                                        </li>
                                        @endforeach
                                    @else
                                        <li>No categories available</li>
                                    @endisset
                                </ul>
                            </div>
                            <!-- Availability Filter -->
                            <div class="filter_box">
                                <h6 class="filter_name">Availability</h6>
                                <ul class="cuschecbox filter_list" id="availabilityFilter">
                                    <li>
                                        <div class="form-group">
                                            <input type="checkbox" id="onsale" 
                                                    class="filter-checkbox" 
                                                    data-type="availability" 
                                                    value="sale" 
                                                    {{ in_array('sale', request('availability', [])) ? 'checked' : '' }} />
                                            <label for="onsale">On sale <span>({{ $saleProductsCount ?? 0 }})</span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input type="checkbox" id="instock" 
                                                    class="filter-checkbox" 
                                                    data-type="availability" 
                                                    value="instock" 
                                                    {{ in_array('instock', request('availability', [])) ? 'checked' : '' }} />
                                            <label for="instock">In stock <span>({{ $inStockCount ?? 0 }})</span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <input type="checkbox" id="outstock" 
                                                    class="filter-checkbox" 
                                                    data-type="availability" 
                                                    value="outstock" 
                                                    {{ in_array('outstock', request('availability', [])) ? 'checked' : '' }} />
                                            <label for="outstock">Out of stock <span>({{ $outOfStockCount ?? 0 }})</span></label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Price Filter -->
                            <div class="filter_box">
                                <h6 class="filter_name">Price</h6>
                                <div class="price_filter d-flex align-items-end">
                                    <div class="form">
                                        <div class="small">From</div>
                                        <div class="input_box position-relative">
                                            <input type="number" class="form-control price-input" 
                                                    id="min_price" min="0" value="{{ request('min_price', 0) }}" 
                                                    placeholder="0" data-type="min_price" />
                                            <span class="position-absolute">₹</span>
                                        </div>
                                    </div>
                                    <span class="mx-2 px-1">-</span>
                                    <div class="to">
                                        <div class="small">To</div>
                                        <div class="input_box position-relative">
                                            <input type="number" class="form-control price-input" 
                                                    id="max_price" placeholder="10000" 
                                                    value="{{ request('max_price', 10000) }}" data-type="max_price"/>
                                            <span class="position-absolute">₹</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <h5 class="cat_name fw-normal pb-3">Products</h5>

                    <div class="product_filter d-flex justify-content-between align-items-center gap-3 pb-3 border-bottom mb-3">
                        <span class="total_products" id="totalProducts">
                            @isset($products)
                                {{ $products->total() }} Products
                            @else
                                0 Products
                            @endisset
                        </span>
                        <div class="sorting">
                            <div class="form-group d-flex align-items-center">
                                <label class="text-nowrap pe-1" for="sort_by">Sort By:</label>
                                <select name="sort_by" id="sort_by" class="form-control opacity-75">
                                    <option value="created_at" {{ request('sort_by', 'created_at') == 'created_at' ? 'selected' : '' }}>Newest</option>
                                    <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Alphabetically, A-Z</option>
                                    <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Alphabetically, Z-A</option>
                                    <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price, low to high</option>
                                    <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price, high to low</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="product_list_sec">
                        <div id="productsContainer">
                             @isset($products)
                            @include('partials.products-list', ['products' => $products])
                               @else
                                <div class="text-center py-5">
                                    <p class="text-muted">No products available.</p>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Loading Spinner -->
<div id="loadingSpinner" class="d-none text-center py-5">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <p class="mt-2">Loading products...</p>
</div>


@endsection

@section('scripts')
<script src="{{ asset('assets/frontend/js/shop-filters.js') }}"></script>
@endsection