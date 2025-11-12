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


// Wishlist functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize wishlist icons
    initializeWishlistIcons();

    // Load wishlist count on page load
    loadWishlistCount();
});

function initializeWishlistIcons() {
    const wishlistIcons = document.querySelectorAll('.wishlist-toggle');
    
    wishlistIcons.forEach(icon => {
        // Add click event
        icon.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const productId = this.getAttribute('data-product-id');
            const productTitle = this.getAttribute('data-product-title');
            
            toggleWishlist(productId, productTitle, this);
        });

        // Check initial state for this product
        const productId = icon.getAttribute('data-product-id');
        checkWishlistState(productId, icon);
    });
}

function toggleWishlist(productId, productTitle, icon) {
    // Check if icon exists
    if (!icon) {
        console.error('Wishlist icon element not found');
        return;
    }

    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]') ? 
        document.querySelector('meta[name="csrf-token"]').getAttribute('content') : 
        '{{ csrf_token() }}';

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
            // Update wishlist icon - with null check
            if (icon) {
                updateWishlistIcon(icon, data.is_in_wishlist);
            }
            
            // Update wishlist count
            updateWishlistCount(data.wishlist_count);
            
            // Show success message
            showWishlistToast(data.message, data.is_in_wishlist);
            
            // Update tooltip - with null check
            if (icon) {
                updateWishlistTooltip(icon, data.is_in_wishlist);
            }
        } else {
            throw new Error(data.message || 'Failed to update wishlist');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showWishlistToast('Failed to update wishlist', false);
    });
}

function updateWishlistIcon(icon, isInWishlist) {
    if (!icon) return;
    
    // Get the SVG element
    const heartSvg = icon.querySelector('svg');
    if (!heartSvg) return;

    // Remove all Font Awesome classes
    heartSvg.className = 'svg-inline--fa';
    
    if (isInWishlist) {
        heartSvg.classList.add('fa-solid', 'fa-heart');
        icon.classList.add('active');
    } else {
        heartSvg.classList.add('fa-regular', 'fa-heart');
        icon.classList.remove('active');
    }
}

function updateWishlistTooltip(icon, isInWishlist) {
    // Add null check
    if (!icon) {
        return;
    }

    const tooltip = bootstrap.Tooltip.getInstance(icon);
    if (tooltip) {
        tooltip.setContent({ '.tooltip-inner': isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' });
    }
}

function updateWishlistCount(count) {
    const wishlistCountElements = document.querySelectorAll('.wishlist-count, .header-wishlist .count');
    wishlistCountElements.forEach(element => {
        if (element) {
            element.textContent = count;
            if (count > 0) {
                element.style.display = 'inline';
            } else {
                element.style.display = 'none';
            }
        }
    });
}

function checkWishlistState(productId, icon) {
    if (!icon) return;

    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]') ? 
        document.querySelector('meta[name="csrf-token"]').getAttribute('content') : 
        '{{ csrf_token() }}';

    // Check if product is in wishlist
    fetch('{{ route("wishlist.check") }}', {  // You'll need to create this route
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
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateWishlistIcon(icon, data.is_in_wishlist);
            updateWishlistTooltip(icon, data.is_in_wishlist);
        }
    })
    .catch(error => {
        console.error('Error checking wishlist state:', error);
    });
}

function showWishlistToast(message, isAdded) {
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-bg-${isAdded ? 'success' : 'info'} border-0`;
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    
    const iconClass = isAdded ? 'fa-heart' : 'fa-heart-crack';
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center">
                <i class="fas ${iconClass} me-2"></i>
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    
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
        autohide: true,
        delay: 3000
    });
    bsToast.show();
    
    // Remove toast from DOM after hide
    toast.addEventListener('hidden.bs.toast', () => {
        toast.remove();
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