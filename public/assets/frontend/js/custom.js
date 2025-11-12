/* <![CDATA[ */

jQuery(document).ready(function() {
    jQuery(".offer_slider").slick({
        arrows: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 5000,
        slidesToShow: 1,
        slidesToScroll: 1,
    });
    
    jQuery(".hero_slider").slick({
        arrows: true,
        dots: true,
        autoplay: true,
        autoplaySpeed: 50000,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 700,
                settings: {
                    arrows: false,
                }
            }
        ]
    });
    
    jQuery(".new_arrival_slider").slick({
        arrows: true,
        dots: false,
        autoplay: true,
        autoplaySpeed: 5000,
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });

    jQuery(".best_seller_slider").slick({
        arrows: true,
        dots: false,
        autoplay: true,
        autoplaySpeed: 5000,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });
    
    
    jQuery(".testimonial_slider").slick({
        arrows: true,
        dots: false,
        autoplay: true,
        autoplaySpeed: 5000,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    dots: true,
                    autoplaySpeed: 8000,
                }
            }
        ]
    });

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Change tab on hover instead of click
    document.querySelectorAll('#pills-tab [data-bs-toggle="pill"]').forEach(tab => {
        tab.addEventListener('mouseenter', function () {
        let tabTrigger = new bootstrap.Tab(this);
        tabTrigger.show();
        });
    });

    

    $(".search-trigger").click(function() {
        $('#searchbar').addClass("active");
    });
    $("#closeSearch").click(function() {
        $('#searchbar').removeClass("active");
    });

    document.getElementById("shipAddress").addEventListener("change", function() {
        const collapseElement = document.getElementById("shipping_fields");
        const collapse = new bootstrap.Collapse(collapseElement, {
            toggle: false // prevent auto toggle on init
        });

        if (this.checked) {
            collapse.show();
        } else {
            collapse.hide();
        }
    });
});



/* ]]&gt; */


// single product page js code
var swiper = new Swiper(".mySwiper", {
  spaceBetween: 10,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,
  direction: "vertical",

  // ✅ Responsive breakpoints
  breakpoints: {
    0: {
      direction: "horizontal", // 992px se niche
      slidesPerView: 4
    },
    992: {
      direction: "vertical",   // 992px se upar
      slidesPerView: 4
    }
  }
});

var swiper2 = new Swiper(".mySwiper2", {
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});



// zoom effect 
// $("#zoomImage").ezPlus();




// Clear localStorage on frontend logout
document.addEventListener('DOMContentLoaded', function() {
    // Check if user is logged out using data attribute
    const isAuthenticated = document.documentElement.getAttribute('data-is-authenticated') === 'true';
    
    if (!isAuthenticated) {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user');
        localStorage.removeItem('token_expires_at');
    }
    
    // Add logout confirmation
    const logoutForms = document.querySelectorAll('form[action*="logout"]');
    logoutForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
                // Clear localStorage
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user');
                localStorage.removeItem('token_expires_at');
                // Submit the form
                this.submit();
            
        });
    });
});


// custom.js - Main functionality including wishlist
class CustomApp {
    constructor() {
        this.init();
    }

    init() {
        this.initializeWishlist();
        this.initializeCart();
        this.initializeSearch();
        this.initializeOtherFeatures();
    }

    // Wishlist functionality
    initializeWishlist() {
        this.setupWishlistEventListeners();
        this.loadWishlistCount();
    }

    setupWishlistEventListeners() {
        // Event delegation for wishlist buttons
        document.addEventListener('click', (e) => {
            const wishlistBtn = e.target.closest('.wishlist-toggle, .wishlist-btn');
            if (wishlistBtn) {
                e.preventDefault();
                this.handleWishlistToggle(wishlistBtn);
            }
        });
    }

    handleWishlistToggle(button) {
        const productId = button.getAttribute('data-product-id');
        const productTitle = button.getAttribute('data-product-title');
        const heartIcon = button.querySelector('i');
        
        if (!productId) {
            console.error('No product ID found for wishlist toggle');
            return;
        }

        // Show loading state
        const originalClass = heartIcon.className;
        heartIcon.className = 'fa-solid fa-spinner fa-spin';

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Toggle wishlist via AJAX
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
                // Update icon
                if (data.in_wishlist) {
                    heartIcon.className = 'fa-solid fa-heart text-danger';
                    button.setAttribute('data-bs-title', 'Remove from Wishlist');
                    this.showToast('success', `${productTitle} added to wishlist`);
                } else {
                    heartIcon.className = 'fa-regular fa-heart';
                    button.setAttribute('data-bs-title', 'Add to Wishlist');
                    this.showToast('info', `${productTitle} removed from wishlist`);
                }

                // Update tooltip
                this.updateTooltip(button);

                // Update wishlist count
                this.updateWishlistCount(data.wishlist_count);
            } else {
                throw new Error(data.message || 'Failed to update wishlist');
            }
        })
        .catch(error => {
            console.error('Wishlist error:', error);
            heartIcon.className = originalClass;
            this.showToast('error', 'Failed to update wishlist');
        });
    }

    updateWishlistCount(count) {
        const wishlistCountElements = document.querySelectorAll('.wishlist-count');
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

    loadWishlistCount() {
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
            this.updateWishlistCount(data.wishlist_count);
        })
        .catch(error => {
            console.error('Error loading wishlist count:', error);
        });
    }

    // Cart functionality
    initializeCart() {
        this.loadCartCount();
    }

    loadCartCount() {
        fetch('{{ route("cart.data") }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            this.updateCartCount(data.cart_count);
        })
        .catch(error => {
            console.error('Error loading cart count:', error);
        });
    }

    updateCartCount(count) {
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(element => {
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

    // Toast notifications
    showToast(type, message) {
        // Your existing toast implementation
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-bg-${type} border-0`;
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        let toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toastContainer';
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            document.body.appendChild(toastContainer);
        }

        toastContainer.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();

        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }

    // Update tooltip
    updateTooltip(element) {
        const tooltip = bootstrap.Tooltip.getInstance(element);
        if (tooltip) {
            tooltip.dispose();
        }
        new bootstrap.Tooltip(element);
    }

    // Search functionality
    initializeSearch() {
        // Your search implementation
        const searchTrigger = document.querySelector('.search-trigger');
        const closeSearch = document.getElementById('closeSearch');
        const searchbar = document.getElementById('searchbar');

        if (searchTrigger && searchbar) {
            searchTrigger.addEventListener('click', () => {
                searchbar.style.display = 'block';
            });
        }

        if (closeSearch && searchbar) {
            closeSearch.addEventListener('click', () => {
                searchbar.style.display = 'none';
            });
        }
    }

    initializeOtherFeatures() {
        // Initialize other features like sliders, etc.
        this.initializeSliders();
    }

    initializeSliders() {
        // Your slick slider initialization
        if (typeof $.fn.slick !== 'undefined') {
            $('.common_slider').slick({
                dots: false,
                arrows: false,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true,
                autoplay: true,
                autoplaySpeed: 3000
            });
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.customApp = new CustomApp();
});

// Make functions globally available for backward compatibility
function updateWishlistCount(count) {
    if (window.customApp) {
        window.customApp.updateWishlistCount(count);
    }
}

function fetchWishlistCount() {
    if (window.customApp) {
        window.customApp.loadWishlistCount();
    }
}

function updateCartCount(count) {
    if (window.customApp) {
        window.customApp.updateCartCount(count);
    }
}

function fetchCartCount() {
    if (window.customApp) {
        window.customApp.loadCartCount();
    }
}
