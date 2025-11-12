    <!-- Products will be loaded here via AJAX -->

    <ul class="productlist column-lg-3 column-2">
        @foreach($products as $product)
        <li>
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
        </li>
        @endforeach
    </ul>

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

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Add to Cart functionality for home page products
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const productId = this.getAttribute('data-product-id');
            const productTitle = this.getAttribute('data-product-title');
            const productPrice = this.getAttribute('data-product-price');
            const productImage = this.getAttribute('data-product-image');
            const productSlug = this.getAttribute('data-product-slug');
            
            addToCart(productId, productTitle, productPrice, productImage, productSlug, this);
        });
    });

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

    function showToast(type, message, showViewCart = false) {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-bg-${type === 'success' ? 'success' : 'danger'} border-0`;
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

    // Load cart count on page load
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

    // Initialize cart count
    loadCartCount();
});






</script>
