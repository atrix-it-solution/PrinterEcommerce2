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

    // Check initial state for all products
    const wishlistIcons = document.querySelectorAll('.wishlist-toggle');
    wishlistIcons.forEach(icon => {
        const productId = icon.getAttribute('data-product-id');
        this.checkWishlistState(productId, icon);
    });
}

    toggleWishlist(productId, productTitle, icon) {
        if (!icon || !this.routes.toggle) {
            console.error('Wishlist icon element not found or route not defined');
            return;
        }

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        // Send AJAX request to toggle wishlist
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
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update ALL wishlist icons for this product
                this.updateAllWishlistIcons(productId, data.is_in_wishlist);
                
                // Update wishlist count
                this.updateWishlistCount(data.wishlist_count);
                
                // Show success message
                this.showWishlistToast(data.message, data.is_in_wishlist);
            } else {
                throw new Error(data.message || 'Failed to update wishlist');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            this.showWishlistToast('Failed to update wishlist', false);
        });
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
    
    // Get the SVG element
    const heartSvg = icon.querySelector('svg');
    if (!heartSvg) return;

    // Instead of modifying className directly, use setAttribute
    // Remove all existing classes and add new ones
    if (isInWishlist) {
        // Solid heart (filled) - added to wishlist
        heartSvg.setAttribute('class', 'svg-inline--fa fa-solid fa-heart');
        heartSvg.style.color = '#dc3545'; // Red color
        icon.classList.add('active');
    } else {
        // Regular heart (outline) - removed from wishlist
        heartSvg.setAttribute('class', 'svg-inline--fa fa-regular fa-heart');
        heartSvg.style.color = ''; // Reset to default
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
        if (!icon || !this.routes.check) return;

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        // Check if product is in wishlist
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
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                this.updateWishlistIcon(icon, data.is_in_wishlist);
                this.updateWishlistTooltip(icon, data.is_in_wishlist);
            }
        })
        .catch(error => {
            console.error('Error checking wishlist state:', error);
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

        fetch(this.routes.data, {
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
            this.updateWishlistCount(data.wishlist_count);
        })
        .catch(error => {
            console.error('Error loading wishlist count:', error);
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