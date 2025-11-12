@extends('layouts.frontend.master')

@section('title', 'Category')

@section('content')
        <div class="bodyWrapper flex-grow-1">
            <section class="shop_header py-5">
                <div class="container text-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center mb-1">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 text-white">{{ $category->title }}</h1>
                </div>
            </section>
            
            <section class="shop_sec py-5">
                <div class="container py-lg-3">
                    <div class="row gx-lg-5">
                        <div class="col-lg-3">
                           
                            <div class="filter pb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="fw-normal">Filter</h5>
                                    <a href="javascript:void(0);" class="clearAll small text-decoration-underline">Clear all</a>
                                </div>

                                <div class="selected_items pt-1">
                                    <!-- <span class="badge fw-normal d-flex align-items-center rounded-pill text">In Stock <a href="javascript:void(0);" class="reset_filter"><i class="fa-solid fa-times"></i></a></span>
                                    <span class="badge fw-normal d-flex align-items-center rounded-pill text">&#8377;0.00 - &#8377;600 <a href="javascript:void(0);" class="reset_filter"><i class="fa-solid fa-times"></i></a></span>
                                    <span class="badge fw-normal d-flex align-items-center rounded-pill text">On Sale <a href="javascript:void(0);" class="reset_filter"><i class="fa-solid fa-times"></i></a></span> -->
                                </div>
                            </div>

                            <div class="filter_inner">
                                

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
                                                <label for="onsale">On sale <span>({{ $saleProductsCount }})</span></label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="instock" 
                                                        class="filter-checkbox" 
                                                        data-type="availability" 
                                                        value="instock" 
                                                        {{ in_array('instock', request('availability', [])) ? 'checked' : '' }} />
                                                <label for="instock">In stock <span>({{ $inStockCount }})</span></label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="outstock" 
                                                        class="filter-checkbox" 
                                                        data-type="availability" 
                                                        value="outstock" 
                                                        {{ in_array('outstock', request('availability', [])) ? 'checked' : '' }} />
                                                <label for="outstock">Out of stock <span>({{ $outOfStockCount }})</span></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

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

                        <div class="col-lg-9">
                            <h5 class="cat_name fw-normal pb-3">{{ $category->title }}</h5>
                            

                           <div class="product_filter d-flex justify-content-between align-items-center gap-3 pb-3 border-bottom mb-3">
                                <span class="total_products">{{ $products->total() }} Products</span>
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