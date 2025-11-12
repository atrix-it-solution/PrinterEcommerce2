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
                                <a href="javascript:void(0);" id="clearAll" class="clearAll small text-decoration-underline">Clear all</a>
                                
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

<script>
    // Wishlist state management
function getWishlistState() {
    return JSON.parse(sessionStorage.getItem('wishlistState') || '{}');
}

function setWishlistState(productId, isInWishlist) {
    const wishlistState = getWishlistState();
    wishlistState[productId] = isInWishlist;
    sessionStorage.setItem('wishlistState', JSON.stringify(wishlistState));
}

function syncWishlistState() {
    // Sync with server on page load
    fetch('{{ route("wishlist.data") }}', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.wishlist_items) {
            const wishlistState = {};
            data.wishlist_items.forEach(item => {
                wishlistState[item.product_id] = true;
            });
            sessionStorage.setItem('wishlistState', JSON.stringify(wishlistState));
        }
    })
    .catch(error => {
        console.error('Error syncing wishlist state:', error);
    });
}

// Call this on page load
syncWishlistState();


    document.addEventListener('DOMContentLoaded', function() {
        let filterTimeout;
        let currentFilters = {
            category: @json(request('category', [])),
            availability: @json(request('availability', [])),
            min_price: {{ request('min_price', 0) }},
            max_price: {{ request('max_price', 10000) }},
            sort_by: '{{ request('sort_by', 'created_at') }}'
        };

        // Initialize
        updateActiveFilters();
        initializeEventListeners();
        loadWishlistCount();
        loadCartCount();

        function initializeEventListeners() {
            // Checkbox filter change
            document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const type = this.dataset.type;
                    const value = this.value;
                    
                    if (this.checked) {
                        if (!currentFilters[type].includes(value)) {
                            currentFilters[type].push(value);
                        }
                    } else {
                        currentFilters[type] = currentFilters[type].filter(item => item !== value);
                    }
                    
                    applyFilters();
                });
            });

            // Price filter change with debounce
            document.querySelectorAll('.price-input').forEach(input => {
                input.addEventListener('input', function() {
                    const type = this.dataset.type;
                    currentFilters[type] = this.value || (type === 'min_price' ? 0 : 10000);
                    
                    clearTimeout(filterTimeout);
                    filterTimeout = setTimeout(() => {
                        applyFilters();
                    }, 800);
                });
            });

            // Sort change
            document.getElementById('sort_by').addEventListener('change', function() {
                currentFilters.sort_by = this.value;
                applyFilters();
            });

            // Clear all filters
            document.getElementById('clearAll').addEventListener('click', function(e) {
                e.preventDefault();
                currentFilters = {
                    category: [],
                    availability: [],
                    min_price: 0,
                    max_price: 10000,
                    sort_by: 'created_at'
                };
                
                // Reset checkboxes
                document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
                    checkbox.checked = false;
                });
                
                // Reset price inputs
                document.getElementById('min_price').value = 0;
                document.getElementById('max_price').value = 10000;
                
                // Reset sort
                document.getElementById('sort_by').value = 'created_at';
                
                applyFilters();
            });
        }

        function applyFilters() {
    showLoading();
    
    const queryString = new URLSearchParams();
    
    // Add filters to query string
    Object.keys(currentFilters).forEach(key => {
        if (Array.isArray(currentFilters[key]) && currentFilters[key].length > 0) {
            currentFilters[key].forEach(value => {
                queryString.append(`${key}[]`, value);
            });
        } else if (!Array.isArray(currentFilters[key]) && currentFilters[key]) {
            queryString.append(key, currentFilters[key]);
        }
    });

    console.log('Applying filters:', currentFilters);
    console.log('Fetching URL:', `/shop?${queryString.toString()}`);

    fetch(`/shop?${queryString.toString()}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('AJAX Response:', data);
        if (data.success) {
            updateProducts(data.products);
            updatePagination(data.pagination);
            updateTotalProducts(data.total_products);
            updateActiveFilters();
            updateURL(queryString.toString());
        } else {
            throw new Error(data.error || 'Failed to load products');
        }
        hideLoading();
    })
    .catch(error => {
        console.error('Error applying filters:', error);
        showToast('error', 'Failed to load products');
        hideLoading();
    });
}

        function updateProducts(products) {
    console.log('Updating products with wishlist status:', products);
    const container = document.getElementById('productsContainer');
    
    if (!products || products.length === 0) {
        container.innerHTML = `
            <div class="text-center py-5">
                <p class="text-muted">No products found matching your criteria.</p>
                <a href="/shop" class="btn btn-primary">Clear Filters</a>
            </div>
        `;
        return;
    }

    // Get client-side wishlist state
    const wishlistState = getWishlistState();
    
    let productsHTML = '<ul class="productlist column-3">';
    
    products.forEach(product => {
        // Calculate discount percentage if sale price exists
        const discount = product.discount || 0;
        
        // Determine wishlist icon and tooltip - Use client-side state as primary source
        const serverWishlistStatus = product.in_wishlist || false;
        const clientWishlistStatus = wishlistState[product.id] || false;
        
        // Use client-side state if available, otherwise use server state
        const isInWishlist = clientWishlistStatus || serverWishlistStatus;
        
        const heartIconClass = isInWishlist ? 'fa-solid fa-heart text-danger' : 'fa-regular fa-heart';
        const wishlistTooltip = isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist';
        
        console.log(`Product ${product.id} wishlist status:`, {
            server: serverWishlistStatus,
            client: clientWishlistStatus,
            final: isInWishlist
        });
        
        productsHTML += `
            <li>
                <div class="product_box">
                    <div class="product_img">
                        <a href="${product.url}">
                            <img src="${product.image}" alt="${product.title}" class="img-fluid" />
                            <img src="${product.image}" alt="${product.title}" class="img-fluid hover_img" />
                        </a>
                        <div class="cart_btn">
                            <button class="cusbtn cartbtn add-to-cart" 
                                data-product-id="${product.id}"
                                data-product-title="${product.title}"
                                data-product-price="${product.sale_price || product.regular_price}"
                                data-product-image="${product.image}"
                                data-product-slug="${product.slug}">
                                Add to cart
                            </button>
                        </div>
                    </div>
                
                    <div class="product_meta">
                        ${discount > 0 ? `<div class="discount_percent">-${discount}%</div>` : ''}
                        <div class="wishlist">
                            <span class="wishlist-toggle wishlist-btn" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                data-bs-custom-class="custom-tooltip" 
                                data-bs-title="${wishlistTooltip}"
                                data-product-id="${product.id}"
                                data-product-title="${product.title}"
                                data-in-wishlist="${isInWishlist}">
                                <i class="${heartIconClass}"></i>
                            </span>
                        </div>
                    </div>
                    <div class="product_content">
                        <h4><a href="${product.url}">${product.title}</a></h4>
                        <div class="price">
                            ${product.sale_price ? 
                                `<del>₹${product.regular_price}</del><ins>₹${product.sale_price}</ins>` : 
                                `<ins>₹${product.regular_price}</ins>`
                            }
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
            </li>
        `;
    });
    
    productsHTML += '</ul>';
    container.innerHTML = productsHTML;
    
    // Re-initialize functionality for new products
    initializeWishlistButtons();
    initializeAddToCartButtons();
    
    // Initialize tooltips for new elements
    const tooltipTriggerList = [].slice.call(container.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

        // Improved Wishlist functionality
        function initializeWishlistButtons() {
            // Use event delegation for better performance
            document.addEventListener('click', function(e) {
                if (e.target.closest('.wishlist-toggle')) {
                    const button = e.target.closest('.wishlist-toggle');
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const productId = button.getAttribute('data-product-id');
                    const productTitle = button.getAttribute('data-product-title');
                    const heartIcon = button.querySelector('i');
                    
                    toggleWishlist(productId, productTitle, heartIcon, button);
                }
            });
        }

       function toggleWishlist(productId, productTitle, heartIcon, button) {
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]') ? 
        document.querySelector('meta[name="csrf-token"]').getAttribute('content') : 
        '{{ csrf_token() }}';

    // Show loading state on the heart icon - ADD NULL CHECK
    if (!heartIcon) {
        console.error('Heart icon not found for product:', productId);
        return;
    }
    
    const originalClass = heartIcon.className;
    heartIcon.className = 'fa-solid fa-spinner fa-spin';

    // Send AJAX request to toggle wishlist
    fetch('{{ route("wishlist.toggle") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Update session storage
            setWishlistState(productId, data.in_wishlist);
            
            // Update ALL wishlist buttons for this product on the page
            updateAllWishlistIcons(productId, data.in_wishlist);
            
            // Update wishlist count
            updateWishlistCount(data.wishlist_count);
            
            // Show success message
            if (data.in_wishlist) {
                showToast('success', productTitle + ' has been added to your wishlist.');
            } else {
                showToast('info', productTitle + ' has been removed from your wishlist.');
            }
        } else {
            throw new Error(data.message || 'Failed to update wishlist');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Failed to update wishlist');
        // Revert to original state on error
        if (heartIcon) {
            heartIcon.className = originalClass;
        }
    });
}

        // Function to update ALL wishlist icons for a specific product
        function updateAllWishlistIcons(productId, isInWishlist) {
            const allWishlistButtons = document.querySelectorAll(`.wishlist-toggle[data-product-id="${productId}"]`);
            
            allWishlistButtons.forEach(button => {
                const heartIcon = button.querySelector('i');
                const productTitle = button.getAttribute('data-product-title');
                
                // Update the data attribute
                button.setAttribute('data-in-wishlist', isInWishlist);
                
                // Update heart icon
                if (isInWishlist) {
                    heartIcon.className = 'fa-solid fa-heart text-danger';
                    button.setAttribute('data-bs-title', 'Remove from Wishlist');
                } else {
                    heartIcon.className = 'fa-regular fa-heart';
                    button.setAttribute('data-bs-title', 'Add to Wishlist');
                }
                
                // Update tooltip
                const tooltip = bootstrap.Tooltip.getInstance(button);
                if (tooltip) {
                    tooltip.dispose();
                }
                new bootstrap.Tooltip(button);
            });
        }

        function updateWishlistCount(count) {
            const wishlistCountElements = document.querySelectorAll('.wishlist-count, .header-wishlist .count');
            wishlistCountElements.forEach(element => {
                element.textContent = count;
                if (count > 0) {
                    element.style.display = 'inline';
                } else {
                    element.style.display = 'none';
                }
            });
        }

        function loadWishlistCount() {
            fetch('{{ route("wishlist.data") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                updateWishlistCount(data.wishlist_count);
            })
            .catch(error => {
                console.error('Error loading wishlist count:', error);
            });
        }

        // Add to Cart functionality
        function initializeAddToCartButtons() {
            document.addEventListener('click', function(e) {
                if (e.target.closest('.add-to-cart')) {
                    const button = e.target.closest('.add-to-cart');
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const productId = button.getAttribute('data-product-id');
                    const productTitle = button.getAttribute('data-product-title');
                    const productPrice = button.getAttribute('data-product-price');
                    const productImage = button.getAttribute('data-product-image');
                    const productSlug = button.getAttribute('data-product-slug');
                    
                    addToCart(productId, productTitle, productPrice, productImage, productSlug, button);
                }
            });
        }

        function addToCart(productId, productTitle, productPrice, productImage, productSlug, button) {
            // Show loading state
            const originalText = button.textContent;
            button.textContent = 'Adding...';
            button.disabled = true;

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]') ? 
                document.querySelector('meta[name="csrf-token"]').getAttribute('content') : 
                '{{ csrf_token() }}';

            // Send AJAX request to add to cart
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update cart count
                    updateCartCount(data.cart_count);
                    
                    // Show success message
                    showToast('success', productTitle + ' has been added to your cart.', true);
                    
                    // Reset button after delay
                    setTimeout(() => {
                        button.textContent = originalText;
                        button.disabled = false;
                    }, 2000);
                } else {
                    throw new Error(data.message || 'Failed to add product to cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('error', 'Failed to add product to cart');
                
                // Reset button
                button.textContent = originalText;
                button.disabled = false;
            });
        }

        function updateCartCount(count) {
            const cartCountElements = document.querySelectorAll('.cart-count-badge, .header-cart .count');
            cartCountElements.forEach(element => {
                element.textContent = count;
                if (count > 0) {
                    element.style.display = 'inline';
                } else {
                    element.style.display = 'none';
                }
            });
        }

        function loadCartCount() {
            fetch('{{ route("cart.data") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                updateCartCount(data.cart_count);
            })
            .catch(error => {
                console.error('Error loading cart count:', error);
            });
        }

        // Toast notification function
        function showToast(type, message, showViewCart = false) {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-bg-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} border-0`;
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');
            
            let toastBody = '';
            if (showViewCart) {
                toastBody = `
                    <div class="d-flex align-items-center">
                        <div class="toast-body flex-grow-1 small">
                            ${message}
                        </div>
                        <div class="me-2">
                            <a href="{{ route('cart.view') }}" class="btn btn-light btn-sm small text-nowrap">View Cart</a>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                `;
            } else {
                toastBody = `
                    <div class="d-flex">
                        <div class="toast-body">
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                `;
            }
            
            toast.innerHTML = toastBody;
            
            // Add to toast container
            let toastContainer = document.getElementById('toastContainer');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toastContainer';
                toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
                document.body.appendChild(toastContainer);
            }
            
            toastContainer.appendChild(toast);
            
            // Initialize and show toast
            const bsToast = new bootstrap.Toast(toast, {
                autohide: showViewCart ? false : true,
                delay: showViewCart ? 5000 : 3000
            });
            bsToast.show();
            
            // Remove toast from DOM after hide
            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }

        // Rest of your functions (pagination, etc.) remain the same...
        function updatePagination(pagination) {
            const container = document.getElementById('productsContainer');
            
            // Remove existing pagination if any
            const existingPagination = container.querySelector('.pagination');
            if (existingPagination) {
                existingPagination.remove();
            }
            
            // Only show pagination if there are multiple pages
            if (pagination.last_page > 1) {
                let paginationHTML = '<ul class="pagination cuspagination mt-4 pt-3 gap-1 justify-content-center">';
                
                // Previous button
                if (pagination.prev_url) {
                    paginationHTML += `<li class="page-item"><a href="#" class="page-link" onclick="event.preventDefault(); loadPage('${pagination.prev_url}');"><i class="fa-solid fa-arrow-left"></i></a></li>`;
                } else {
                    paginationHTML += `<li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-arrow-left"></i></span></li>`;
                }
                
                // Page numbers
                for (let page = 1; page <= pagination.last_page; page++) {
                    if (page === pagination.current_page) {
                        paginationHTML += `<li class="page-item active"><span class="page-link">${page}</span></li>`;
                    } else {
                        const pageUrl = pagination.pages ? pagination.pages[page] : `?page=${page}`;
                        paginationHTML += `<li class="page-item"><a href="#" class="page-link" onclick="event.preventDefault(); loadPage('${pageUrl}');">${page}</a></li>`;
                    }
                }
                
                // Next button
                if (pagination.next_url) {
                    paginationHTML += `<li class="page-item"><a href="#" class="page-link" onclick="event.preventDefault(); loadPage('${pagination.next_url}');"><i class="fa-solid fa-arrow-right"></i></a></li>`;
                } else {
                    paginationHTML += `<li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-arrow-right"></i></span></li>`;
                }
                
                paginationHTML += '</ul>';
                
                // Append pagination after products
                container.insertAdjacentHTML('beforeend', paginationHTML);
            }
        }

        function loadPage(url) {
            showLoading();
            
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    updateProducts(data.products);
                    updatePagination(data.pagination);
                    updateTotalProducts(data.total_products);
                    updateActiveFilters();
                    updateURL(new URL(url).search);
                } else {
                    throw new Error(data.error || 'Failed to load page');
                }
                hideLoading();
            })
            .catch(error => {
                console.error('Error loading page:', error);
                showToast('error', 'Failed to load products');
                hideLoading();
            });
        }

        function updateTotalProducts(total) {
            document.getElementById('totalProducts').textContent = `${total} Products`;
        }

        function updateActiveFilters() {
            const activeFilters = document.getElementById('activeFilters');
            let filtersHTML = '';

            // Category filters
            if (currentFilters.category.length > 0) {
                currentFilters.category.forEach(catId => {
                    const catElement = document.querySelector(`input[value="${catId}"]`);
                    const catName = catElement ? catElement.nextElementSibling.textContent.split(' (')[0] : 'Category';
                    filtersHTML += `<span class="badge fw-normal d-flex align-items-center rounded-pill text me-2 mb-2">${catName} <a href="#" class="reset_filter ms-1" onclick="event.preventDefault(); removeFilter('category', '${catId}')"><i class="fa-solid fa-times"></i></a></span>`;
                });
            }

            // Availability filters
            if (currentFilters.availability.length > 0) {
                currentFilters.availability.forEach(avail => {
                    const availName = avail === 'sale' ? 'On Sale' : 
                                    avail === 'instock' ? 'In Stock' : 'Out of Stock';
                    filtersHTML += `<span class="badge fw-normal d-flex align-items-center rounded-pill text me-2 mb-2">${availName} <a href="#" class="reset_filter ms-1" onclick="event.preventDefault(); removeFilter('availability', '${avail}')"><i class="fa-solid fa-times"></i></a></span>`;
                });
            }

            // Price filter
            if (currentFilters.min_price > 0 || currentFilters.max_price < 10000) {
                filtersHTML += `<span class="badge fw-normal d-flex align-items-center rounded-pill text me-2 mb-2">₹${currentFilters.min_price} - ₹${currentFilters.max_price} <a href="#" class="reset_filter ms-1" onclick="event.preventDefault(); removePriceFilter()"><i class="fa-solid fa-times"></i></a></span>`;
            }

            activeFilters.innerHTML = filtersHTML;
        }

        function removeFilter(type, value) {
            currentFilters[type] = currentFilters[type].filter(item => item !== value);
            
            // Uncheck the checkbox
            const checkbox = document.querySelector(`input[value="${value}"]`);
            if (checkbox) checkbox.checked = false;
            
            applyFilters();
        }

        function removePriceFilter() {
            currentFilters.min_price = 0;
            currentFilters.max_price = 10000;
            
            document.getElementById('min_price').value = 0;
            document.getElementById('max_price').value = 10000;
            
            applyFilters();
        }

        function updateURL(queryString = '') {
            if (!queryString) {
                const tempParams = {...currentFilters};
                delete tempParams.page;
                queryString = new URLSearchParams(tempParams).toString();
            }
            const newUrl = `${window.location.pathname}?${queryString}`;
            window.history.replaceState(null, '', newUrl);
        }

        function showLoading() {
            document.getElementById('loadingSpinner').classList.remove('d-none');
            document.getElementById('productsContainer').classList.add('d-none');
        }

        function hideLoading() {
            document.getElementById('loadingSpinner').classList.add('d-none');
            document.getElementById('productsContainer').classList.remove('d-none');
        }

        // Make functions available globally for onclick events
        window.removeFilter = removeFilter;
        window.removePriceFilter = removePriceFilter;
        window.loadPage = loadPage;
    });
</script>
@endsection