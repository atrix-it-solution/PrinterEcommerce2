<div id="filterForm">
    <div class="filter pb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-normal">Filter</h5>
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
                @foreach($categories as $category)
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