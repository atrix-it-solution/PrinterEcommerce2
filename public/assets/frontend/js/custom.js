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

    // document.getElementById("shipAddress").addEventListener("change", function() {
    //     const collapseElement = document.getElementById("shipping_fields");
    //     const collapse = new bootstrap.Collapse(collapseElement, {
    //         toggle: false // prevent auto toggle on init
    //     });

    //     if (this.checked) {
    //         collapse.show();
    //     } else {
    //         collapse.hide();
    //     }
    // });
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





// Quote Form Handling
class QuoteForm {
    constructor() {
        this.form = document.getElementById('quoteForm');
        this.submitBtn = document.getElementById('submitBtn');
        this.messagesDiv = document.getElementById('formMessages');
        
        if (this.form) {
            this.init();
        }
    }

    init() {
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleSubmit();
        });

        // Auto-fill product data when modal is shown
        this.setupModalListeners();
    }

    setupModalListeners() {
        const quoteModal = document.getElementById('quoteFormModal');
        if (quoteModal) {
            quoteModal.addEventListener('show.bs.modal', (event) => {
                // Get the button that triggered the modal
                const button = event.relatedTarget;
                
                // Extract product data from data attributes
                const productId = button.getAttribute('data-product-id') || '';
                const productName = button.getAttribute('data-product-name') || '';
                const productPrice = button.getAttribute('data-product-price') || '';
                const productUrl = button.getAttribute('data-product-url') || window.location.href;
                
                // Fill the form with product data
                this.fillProductData(productId, productName, productPrice, productUrl);
            });

            // Reset form when modal is hidden
            quoteModal.addEventListener('hidden.bs.modal', () => {
                this.form.reset();
                this.clearMessages();
            });
        }
    }

    fillProductData(productId, productName, productPrice, productUrl) {
        const productIdInput = document.getElementById('product_id');
        const productNameInput = document.getElementById('product_name');
        const productPriceInput = document.getElementById('product_price');
        const productUrlInput = document.getElementById('product_url');
        
        
        if (productIdInput) productIdInput.value = productId;
        if (productNameInput) productNameInput.value = productName;
        if (productPriceInput) productPriceInput.value = productPrice;
        if (productUrlInput) productUrlInput.value = productUrl;
        
        
    }

    async handleSubmit() {
        // Show loading state
        const originalText = this.submitBtn.innerHTML;
        this.submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Sending...';
        this.submitBtn.disabled = true;

        // Clear previous messages
        this.clearMessages();

        try {
            // Get form data
            const formData = new FormData(this.form);
            
          
            

            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Use the form's action attribute
            const actionUrl = this.form.getAttribute('action');
            
           

            // Send AJAX request
            const response = await fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            const data = await response.json();
            
            if (data.success) {
                this.showMessage(data.message, 'success');
                this.form.reset();
                
                // Close modal after 3 seconds
                setTimeout(() => {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('quoteFormModal'));
                    if (modal) {
                        modal.hide();
                    }
                }, 3000);
            } else {
                let errorMessage = data.message || 'Something went wrong. Please try again.';
                this.showMessage(errorMessage, 'error');
                
                // Show validation errors if they exist
                if (data.errors) {
                    this.showValidationErrors(data.errors);
                }
            }
        } catch (error) {
            // console.error('Error submitting quote form:', error);
            this.showMessage(
                'Network error. Please check your connection and try again.', 
                'error'
            );
        } finally {
            // Reset button
            this.submitBtn.innerHTML = originalText;
            this.submitBtn.disabled = false;
        }
    }

    showMessage(message, type) {
        this.clearMessages();
        
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        
        const messageHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="fa-solid ${icon} me-2"></i>
                ${message}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        this.messagesDiv.innerHTML = messageHtml;
    }

    showValidationErrors(errors) {
        let errorHtml = '<div class="alert alert-danger"><strong>Please fix the following errors:</strong><ul class="mb-0 mt-2">';
        
        for (const field in errors) {
            if (errors.hasOwnProperty(field)) {
                errorHtml += `<li>${errors[field][0]}</li>`;
            }
        }
        
        errorHtml += '</ul></div>';
        this.messagesDiv.innerHTML = errorHtml;
    }

    clearMessages() {
        this.messagesDiv.innerHTML = '';
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize quote form
    new QuoteForm();
});


$(".cat_box_wrapper").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: true,
    dots: false,
    // ✅ Responsive settings
    responsive: [
        {
            breakpoint: 1024, // tablet
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 768, // small tablet
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 576, // mobile
            settings: {
                slidesToShow: 1,
            },
        },
    ],
});
 


// Enhanced Search functionality for multiple content types
class SearchManager {
    constructor() {
        this.searchInput = document.getElementById('searchInput');
        this.searchResults = document.getElementById('searchResults');
        this.searchAllResults = document.getElementById('searchAllResults');
        this.seeAllLink = document.getElementById('seeAllLink');
        this.searchTerm = document.getElementById('searchTerm');
        this.searchForm = document.getElementById('searchForm');
        this.timeout = null;
        this.init();
    }

    init() {
        if (!this.searchInput) {
            return;
        }

        // Live search on input
        this.searchInput.addEventListener('input', (e) => {
            this.handleSearch(e.target.value);
        });

        // Form submission
        if (this.searchForm) {
            this.searchForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const query = this.searchInput.value.trim();
                if (query) {
                    window.location.href = `/search-results?q=${encodeURIComponent(query)}&type=all`;
                }
            });
        }

        // Close search when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('#searchbar') && !e.target.closest('.search-trigger')) {
                this.closeSearch();
            }
        });
    }

    handleSearch(query) {
        clearTimeout(this.timeout);
        
        const trimmedQuery = query.trim();
        
        if (trimmedQuery.length < 2) {
            this.showInitialState();
            return;
        }

        this.timeout = setTimeout(() => {
            this.performSearch(trimmedQuery);
        }, 300);
    }

    performSearch(query) {
        // Show loading state
        this.showLoading();

        // Search for both products and blogs
        fetch(`/search?q=${encodeURIComponent(query)}&limit=5&type=all`)
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(`HTTP ${response.status}: ${text}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    this.displayResults(data.results, data.search_term, data.product_count, data.blog_count);
                } else {
                    this.showError(data.message || 'Search failed');
                }
            })
            .catch(error => {
                console.error('Search error details:', error);
                this.showError('Search temporarily unavailable. Please try again.');
            });
    }

    showLoading() {
        this.searchResults.innerHTML = `
            <div class="text-center py-4">
                <div class="spinner-border text-primary mb-2" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="text-muted mb-0">Searching...</p>
            </div>
        `;
        this.searchAllResults.style.display = 'none';
    }

    displayResults(results, searchTerm, productCount = 0, blogCount = 0) {
        if (!results || results.length === 0) {
            this.searchResults.innerHTML = `
                <div class="text-center py-4">
                    <i class="fa-solid fa-search fa-2x text-muted mb-2"></i>
                    <p class="text-muted mb-0">No results found for "${searchTerm}"</p>
                </div>
            `;
            this.searchAllResults.style.display = 'none';
            return;
        }

        let html = '';
        let productsHtml = '';
        let blogsHtml = '';

        // Separate products and blogs
        const products = results.filter(item => item.type === 'product');
        const blogs = results.filter(item => item.type === 'blog');

        // Generate products HTML
        if (products.length > 0) {
            productsHtml = `
                <div class="search-category mb-4">
                    <h6 class="search-category-title mb-3">Products (${productCount})</h6>
                    <ul class="product_list list-unstyled">
            `;
            
            products.forEach(item => {
                const priceHtml = item.sale_price && item.sale_price < item.regular_price 
                    ? `<div class="price">
                          <del>$${item.regular_price || item.price}</del>
                          <ins>$${item.sale_price}</ins>
                       </div>`
                    : `<div class="price">
                          <ins>$${item.price || item.regular_price}</ins>
                       </div>`;

                productsHtml += `
                    <li class="mb-3">
                        <a href="${item.url}" class="sproduct_box d-flex gap-3 gap-md-4">
                            <div class="product_img">
                                <img src="${item.image}" alt="${item.title}" class="img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                            <div class="product_content flex-grow-1">
                                <h6 class="mb-1">${this.escapeHtml(item.title)}</h6>
                                ${priceHtml}
                            </div>
                        </a>
                    </li>
                `;
            });
            
            productsHtml += '</ul></div>';
        }

        // Generate blogs HTML
        if (blogs.length > 0) {
            blogsHtml = `
                <div class="search-category">
                    <h6 class="search-category-title mb-3">Blog Posts (${blogCount})</h6>
                    <ul class="blog_list list-unstyled">
            `;
            
            blogs.forEach(item => {
                const date = item.created_at ? new Date(item.created_at).toLocaleDateString() : '';
                
                blogsHtml += `
                    <li class="mb-3">
                        <a href="${item.url}" class="sproduct_box d-flex gap-3 gap-md-4">
                            <div class="product_img">
                                <img src="${item.image}" alt="${item.title}" class="img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                            <div class="product_content flex-grow-1">
                                <h6 class="mb-1">${this.escapeHtml(item.title)}</h6>
                                <div class="blog-meta small text-muted mb-1">
                                    ${date} ${item.author ? `• By ${item.author}` : ''}
                                </div>
                                <p class="text-muted small mb-0">${this.escapeHtml(item.description?.substring(0, 60) || '')}...</p>
                            </div>
                        </a>
                    </li>
                `;
            });
            
            blogsHtml += '</ul></div>';
        }

        html = productsHtml + blogsHtml;
        this.searchResults.innerHTML = html;

        // Update "See All Results" link
        if (this.searchTerm) {
            this.searchTerm.textContent = searchTerm;
        }
        if (this.seeAllLink) {
            this.seeAllLink.href = `/search-results?q=${encodeURIComponent(searchTerm)}&type=all`;
        }
        this.searchAllResults.style.display = 'block';
    }

    escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    showInitialState() {
        this.searchResults.innerHTML = `
            <div class="text-center py-4">
                <p class="text-muted">Start typing to search for products and blog posts...</p>
            </div>
        `;
        this.searchAllResults.style.display = 'none';
    }

    showError(message) {
        this.searchResults.innerHTML = `
            <div class="text-center py-4">
                <i class="fa-solid fa-exclamation-triangle text-warning mb-2"></i>
                <p class="text-muted mb-0">${message}</p>
            </div>
        `;
        this.searchAllResults.style.display = 'none';
    }

    closeSearch() {
        const searchbar = document.getElementById('searchbar');
        if (searchbar) {
            searchbar.style.display = 'none';
        }
        if (this.searchInput) {
            this.searchInput.value = '';
        }
        this.showInitialState();
    }
}

// Initialize search when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.searchManager = new SearchManager();
    
    // Update your existing search toggle functionality
    const searchTrigger = document.querySelectorAll('.search-trigger');
    const closeSearch = document.getElementById('closeSearch');
    const searchbar = document.getElementById('searchbar');

    if (searchTrigger && searchbar) {
        searchTrigger.forEach(trigger => {
            trigger.addEventListener('click', function() {
                searchbar.style.display = 'block';
                const searchInput = document.getElementById('searchInput');
                if (searchInput) {
                    searchInput.focus();
                }
            });
        });
    }

    if (closeSearch && searchbar) {
        closeSearch.addEventListener('click', function() {
            searchbar.style.display = 'none';
        });
    }
});