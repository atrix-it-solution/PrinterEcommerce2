// Wishlist functionality
class WishlistManager {
    constructor() {
        this.initialized = false;
        this.routes = {
            toggle: '',
            check: '',
            data: ''
        };
        this.getRoutes();
    }

    getRoutes() {
        const routeElement = document.getElementById('app-routes');
        if (routeElement) {
            this.routes = {
                toggle: routeElement.dataset.wishlistToggle || '',
                check: routeElement.dataset.wishlistCheck || '',
                data: routeElement.dataset.wishlistData || ''
            };
        }
    }

    init() {
        if (this.initialized) return;
        
        this.initializeWishlistIcons();
        this.loadWishlistCount();
        this.initialized = true;
    }

   initializeWishlistIcons() {
    // Use event delegation instead of individual event listeners
        document.addEventListener('click', (e) => {
            const icon = e.target.closest('.wishlist-toggle');
            if (icon) {
                e.preventDefault();
                e.stopPropagation();
                
                const productId = icon.getAttribute('data-product-id');
                const productTitle = icon.getAttribute('data-product-title');
                
                this.toggleWishlist(productId, productTitle, icon);
            }
        });

        // RE-ENABLE INITIAL STATE CHECK - This is crucial!
        const wishlistIcons = document.querySelectorAll('.wishlist-toggle');
        // console.log('Found ' + wishlistIcons.length + ' wishlist icons to check');
        
        wishlistIcons.forEach(icon => {
            const productId = icon.getAttribute('data-product-id');
            // console.log('Checking initial state for product:', productId);
            this.checkWishlistState(productId, icon);
        });
    }
    
    toggleWishlist(productId, productTitle, icon) {
    if (!icon || !this.routes.toggle) {
        // console.error('Wishlist icon element not found or route not defined');
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    // console.log('Toggling wishlist for product:', productId);

    fetch(this.routes.toggle, {
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
        // console.log('Response status:', response.status);
        
        if (response.status === 401) {
            // User not authenticated, redirect to login
            return response.json().then(data => {
                if (data.redirect) {
                    this.redirectToLogin(data.login_url, productId);
                    
                }
                throw new Error(data.message);
            });
        }
        
        if (!response.ok) {
            // Get more detailed error information
            return response.text().then(text => {
                console.error('Server response:', text);
                throw new Error(`Server error: ${response.status} ${response.statusText}`);
            });
        }
        return response.json();
    })
    .then(data => {
        // console.log('Toggle response:', data);
        
        if (data.success) {
            this.updateAllWishlistIcons(productId, data.is_in_wishlist);
            this.updateWishlistCount(data.wishlist_count);
            this.showWishlistToast(data.message, data.is_in_wishlist);
        } else {
            throw new Error(data.message || 'Failed to update wishlist');
        }
    })
    .catch(error => {
        // console.error('Toggle wishlist error:', error);
        if (!error.message.includes('redirect')) {
            this.showWishlistToast('Failed to update wishlist: ' + error.message, false);
        }
    });
}

    redirectToLogin(loginUrl, productId) {
        // Store the product ID in sessionStorage to add to wishlist after login
        sessionStorage.setItem('pending_wishlist_product', productId);
        
        // Show confirmation message
        // if (confirm('Please login to add items to your wishlist. Redirect to login page?')) {
        //     window.location.href = loginUrl;
        // }
    }

    // Check for pending wishlist items after page load
    checkPendingWishlist() {
        const pendingProductId = sessionStorage.getItem('pending_wishlist_product');
        if (pendingProductId && this.isUserLoggedIn()) {
            // User just logged in, add the pending product to wishlist
            this.addPendingWishlistItem(pendingProductId);
            sessionStorage.removeItem('pending_wishlist_product');
        }
    }

    isUserLoggedIn() {
        // Check if user is logged in (you might need to adjust this based on your auth system)
        return document.querySelector('meta[name="user-authenticated"]')?.getAttribute('content') === 'true';
    }

    addPendingWishlistItem(productId) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        fetch(this.routes.toggle, {
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
                this.updateAllWishlistIcons(productId, data.is_in_wishlist);
                this.updateWishlistCount(data.wishlist_count);
                this.showWishlistToast('Product added to your wishlist!', true);
            }
        })
        .catch(error => {
            console.error('Error adding pending wishlist item:', error);
        });
    }

    init() {
        if (this.initialized) return;
        
        this.initializeWishlistIcons();
        this.loadWishlistCount();
        this.checkPendingWishlist(); // Check for pending items
        this.initialized = true;
    }


    updateAllWishlistIcons(productId, isInWishlist) {
        // Find ALL icons for this product across the page
        const allIcons = document.querySelectorAll(`.wishlist-toggle[data-product-id="${productId}"]`);
        
        allIcons.forEach(icon => {
            this.updateWishlistIcon(icon, isInWishlist);
            this.updateWishlistTooltip(icon, isInWishlist);
        });
    }

   updateWishlistIcon(icon, isInWishlist) {
        if (!icon) return;
        
        // Get the SVG element or the icon element
        const heartSvg = icon.querySelector('svg');
        const heartIcon = heartSvg || icon.querySelector('i');
        
        if (!heartIcon) {
            console.warn('No heart icon found in element:', icon);
            return;
        }

        if (isInWishlist) {
            if (heartIcon.tagName === 'svg') {
                heartIcon.setAttribute('class', 'svg-inline--fa fa-solid fa-heart');
            } else if (heartIcon.tagName === 'I') {
                heartIcon.className = 'fa-solid fa-heart';
            }
            icon.classList.add('active');
        } else {
            if (heartIcon.tagName === 'svg') {
                heartIcon.setAttribute('class', 'svg-inline--fa fa-regular fa-heart');
            } else if (heartIcon.tagName === 'I') {
                heartIcon.className = 'fa-regular fa-heart';
            }
            heartIcon.style.color = ''; 
            icon.classList.remove('active');
        }
    }
    updateWishlistTooltip(icon, isInWishlist) {
        if (!icon) return;

        const tooltip = bootstrap.Tooltip.getInstance(icon);
        if (tooltip) {
            tooltip.setContent({ '.tooltip-inner': isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' });
        }
    }

    updateWishlistCount(count) {
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

    checkWishlistState(productId, icon) {
        if (!icon || !this.routes.check) {
            // console.log('No icon or route for checkWishlistState');
            return;
        }

        // console.log('Checking wishlist state for product:', productId, 'Icon element:', icon);

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        fetch(this.routes.check, {
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
            // console.log('Check wishlist response status:', response.status);
            
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Check wishlist server response:', text);
                    throw new Error(`Server error: ${response.status} ${response.statusText}`);
                });
            }
            return response.json();
        })
        .then(data => {
            // console.log('Check wishlist response:', data);
            
            if (data.success) {
                this.updateWishlistIcon(icon, data.is_in_wishlist);
                this.updateWishlistTooltip(icon, data.is_in_wishlist);
            } else {
                console.warn('Check wishlist returned success: false', data);
                this.updateWishlistIcon(icon, false);
            }
        })
        .catch(error => {
            console.error('Error checking wishlist state:', error);
            this.updateWishlistIcon(icon, false);
        });
    }

    showWishlistToast(message, isAdded) {
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

    loadWishlistCount() {
    if (!this.routes.data) {
        console.error('Wishlist data route not defined');
        return;
    }

    // console.log('Loading wishlist count from:', this.routes.data);

    fetch(this.routes.data, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        // console.log('Wishlist count response status:', response.status);
        
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Wishlist count server response:', text);
                throw new Error(`Server error: ${response.status} ${response.statusText}`);
            });
        }
        return response.json();
    })
    .then(data => {
        // console.log('Wishlist count data:', data);
        this.updateWishlistCount(data.wishlist_count);
    })
    .catch(error => {
        console.error('Error loading wishlist count:', error);
        this.updateWishlistCount(0); // Set to 0 on error
    });
    }

    // Method to refresh all wishlist icons (useful after AJAX content loads)
    refreshAllIcons() {
        const allIcons = document.querySelectorAll('.wishlist-toggle');
        allIcons.forEach(icon => {
            const productId = icon.getAttribute('data-product-id');
            this.checkWishlistState(productId, icon);
        });
    }
}



// Create global instance
window.wishlistManager = new WishlistManager();

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.wishlistManager.init();
});