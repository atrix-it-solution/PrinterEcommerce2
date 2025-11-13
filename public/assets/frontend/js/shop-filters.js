// public/assets/frontend/js/shop-filters.js
class ShopFilters {
    constructor(options = {}) {
        this.options = {
            isCategoryPage: false,
            categorySlug: null,
            baseUrl: '/shop',
            ...options
        };
        
        this.currentFilters = {
            category: [],
            availability: [],
            min_price: 0,
            max_price: 10000,
            sort_by: 'created_at'
        };
        
        this.filterTimeout = null;
        this.init();
    }

    init() {
        this.initializeCurrentFilters();
        this.initializeEventListeners();
        this.updateActiveFilters();
    }

    initializeCurrentFilters() {
        const urlParams = new URLSearchParams(window.location.search);
        
        this.currentFilters = {
            category: urlParams.getAll('category[]') || [],
            availability: urlParams.getAll('availability[]') || [],
            min_price: parseInt(urlParams.get('min_price')) || 0,
            max_price: parseInt(urlParams.get('max_price')) || 10000,
            sort_by: urlParams.get('sort_by') || 'created_at'
        };

        this.updateFormElements();
    }

    updateFormElements() {
        // Update checkboxes
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            const type = checkbox.dataset.type;
            const value = checkbox.value;
            
            if (this.currentFilters[type].includes(value)) {
                checkbox.checked = true;
            } else {
                checkbox.checked = false;
            }
        });

        // Update price inputs
        const minPriceInput = document.getElementById('min_price');
        const maxPriceInput = document.getElementById('max_price');
        
        if (minPriceInput) minPriceInput.value = this.currentFilters.min_price;
        if (maxPriceInput) maxPriceInput.value = this.currentFilters.max_price;

        // Update sort select
        const sortSelect = document.getElementById('sort_by');
        if (sortSelect) sortSelect.value = this.currentFilters.sort_by;
    }

    initializeEventListeners() {
        // Checkbox filter change
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                this.handleCheckboxChange(checkbox);
            });
        });

        // Price filter change with debounce
        document.querySelectorAll('.price-input').forEach(input => {
            input.addEventListener('input', () => {
                this.handlePriceInputChange(input);
            });
        });

        // Sort change
        const sortSelect = document.getElementById('sort_by');
        if (sortSelect) {
            sortSelect.addEventListener('change', () => {
                this.currentFilters.sort_by = sortSelect.value;
                this.applyFilters();
            });
        }

        // Clear all filters
        const clearAllBtn = document.getElementById('clearAll');
        if (clearAllBtn) {
            clearAllBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.clearAllFilters();
            });
        }
    }

    handleCheckboxChange(checkbox) {
        const type = checkbox.dataset.type;
        const value = checkbox.value;
        
        if (checkbox.checked) {
            if (!this.currentFilters[type].includes(value)) {
                this.currentFilters[type].push(value);
            }
        } else {
            this.currentFilters[type] = this.currentFilters[type].filter(item => item !== value);
        }
        
        this.applyFilters();
    }

    handlePriceInputChange(input) {
        const type = input.dataset.type;
        this.currentFilters[type] = input.value || (type === 'min_price' ? 0 : 10000);
        
        clearTimeout(this.filterTimeout);
        this.filterTimeout = setTimeout(() => {
            this.applyFilters();
        }, 800);
    }

    applyFilters() {
        this.showLoading();
        
        const queryString = new URLSearchParams();
        
        // Add filters to query string
        Object.keys(this.currentFilters).forEach(key => {
            if (Array.isArray(this.currentFilters[key]) && this.currentFilters[key].length > 0) {
                this.currentFilters[key].forEach(value => {
                    queryString.append(`${key}[]`, value);
                });
            } else if (!Array.isArray(this.currentFilters[key]) && this.currentFilters[key]) {
                queryString.append(key, this.currentFilters[key]);
            }
        });

        // Determine the URL based on page type
        let fetchUrl;
        if (this.options.isCategoryPage && this.options.categorySlug) {
            fetchUrl = `/category/${this.options.categorySlug}?${queryString.toString()}`;
        } else {
            fetchUrl = `/shop?${queryString.toString()}`;
        }

        // console.log('Fetching URL:', fetchUrl);

        fetch(fetchUrl, {
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
                this.updateProducts(data.products);
                this.updatePagination(data.pagination);
                this.updateTotalProducts(data.total_products);
                this.updateActiveFilters();
                this.updateURL(queryString.toString());
            } else {
                throw new Error(data.error || 'Failed to load products');
            }
            this.hideLoading();
        })
        .catch(error => {
            console.error('Error applying filters:', error);
            this.showToast('error', 'Failed to load products');
            this.hideLoading();
        });
    }

    updateProducts(products) {
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

    let productsHTML = '<ul class="productlist column-3">';
    
    products.forEach(product => {
        const discount = product.discount || 0;
        
        productsHTML += `
            <li>
                <div class="product_box">
                    <a href="${product.url}" class="product_img">
                        <img src="${product.image}" alt="${product.title}" class="img-fluid" />
                        <img src="${product.image}" alt="${product.title}" class="img-fluid hover_img" />
                        <div class="cart_btn">
                            <button class="cusbtn cartbtn">View</button>
                        </div>
                    </a>
                
                    <div class="product_meta">
                        ${discount > 0 ? `<div class="discount_percent">-${discount}%</div>` : ''}
                        <div class="wishlist">
                            <span class="wishlist-toggle wishlist-btn" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                data-bs-custom-class="custom-tooltip" 
                                data-bs-title="Add to Wishlist"
                                data-product-id="${product.id}"
                                data-product-title="${product.title}">
                                <i class="fa-regular fa-heart"></i>
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
    
    this.initializeTooltips();
    
    // Use global wishlist manager to refresh icons
    if (window.wishlistManager) {
        setTimeout(() => {
            window.wishlistManager.refreshAllIcons();
        }, 100);
    }
}

    updatePagination(pagination) {
        const container = document.getElementById('productsContainer');
        
        // Remove existing pagination if any
        const existingPagination = container.querySelector('.pagination');
        if (existingPagination) {
            existingPagination.remove();
        }
        
        if (pagination.last_page > 1) {
            let paginationHTML = '<ul class="pagination cuspagination mt-4 pt-3 gap-1 justify-content-center">';
            
            // Previous button
            if (pagination.prev_url) {
                paginationHTML += `<li class="page-item"><a href="#" class="page-link" onclick="event.preventDefault(); window.shopFilters.loadPage('${pagination.prev_url}');"><i class="fa-solid fa-arrow-left"></i></a></li>`;
            } else {
                paginationHTML += `<li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-arrow-left"></i></span></li>`;
            }
            
            // Page numbers
            for (let page = 1; page <= pagination.last_page; page++) {
                if (page === pagination.current_page) {
                    paginationHTML += `<li class="page-item active"><span class="page-link">${page}</span></li>`;
                } else {
                    const pageUrl = pagination.pages ? pagination.pages[page] : `?page=${page}`;
                    paginationHTML += `<li class="page-item"><a href="#" class="page-link" onclick="event.preventDefault(); window.shopFilters.loadPage('${pageUrl}');">${page}</a></li>`;
                }
            }
            
            // Next button
            if (pagination.next_url) {
                paginationHTML += `<li class="page-item"><a href="#" class="page-link" onclick="event.preventDefault(); window.shopFilters.loadPage('${pagination.next_url}');"><i class="fa-solid fa-arrow-right"></i></a></li>`;
            } else {
                paginationHTML += `<li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-arrow-right"></i></span></li>`;
            }
            
            paginationHTML += '</ul>';
            container.insertAdjacentHTML('beforeend', paginationHTML);
        }
    }

    loadPage(url) {
        this.showLoading();
        
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
                this.updateProducts(data.products);
                this.updatePagination(data.pagination);
                this.updateTotalProducts(data.total_products);
                this.updateActiveFilters();
                this.updateURL(new URL(url).search);
            } else {
                throw new Error(data.error || 'Failed to load page');
            }
            this.hideLoading();
        })
        .catch(error => {
            console.error('Error loading page:', error);
            this.showToast('error', 'Failed to load products');
            this.hideLoading();
        });
    }

    updateTotalProducts(total) {
        const totalProductsElement = document.getElementById('totalProducts');
        if (totalProductsElement) {
            totalProductsElement.textContent = `${total} Products`;
        }
    }

    updateActiveFilters() {
        const activeFilters = document.getElementById('activeFilters');
        if (!activeFilters) return;
        
        let filtersHTML = '';

        // Category filters
        if (this.currentFilters.category.length > 0) {
            this.currentFilters.category.forEach(catId => {
                const catElement = document.querySelector(`input[value="${catId}"]`);
                const catName = catElement ? catElement.nextElementSibling.textContent.split(' (')[0] : 'Category';
                filtersHTML += `<span class="badge fw-normal d-flex align-items-center rounded-pill text me-2 mb-2">${catName} <a href="#" class="reset_filter ms-1" onclick="event.preventDefault(); window.shopFilters.removeFilter('category', '${catId}')"><i class="fa-solid fa-times"></i></a></span>`;
            });
        }

        // Availability filters
        if (this.currentFilters.availability.length > 0) {
            this.currentFilters.availability.forEach(avail => {
                const availName = avail === 'sale' ? 'On Sale' : 
                                avail === 'instock' ? 'In Stock' : 'Out of Stock';
                filtersHTML += `<span class="badge fw-normal d-flex align-items-center rounded-pill text me-2 mb-2">${availName} <a href="#" class="reset_filter ms-1" onclick="event.preventDefault(); window.shopFilters.removeFilter('availability', '${avail}')"><i class="fa-solid fa-times"></i></a></span>`;
            });
        }

        // Price filter
        if (this.currentFilters.min_price > 0 || this.currentFilters.max_price < 10000) {
            filtersHTML += `<span class="badge fw-normal d-flex align-items-center rounded-pill text me-2 mb-2">₹${this.currentFilters.min_price} - ₹${this.currentFilters.max_price} <a href="#" class="reset_filter ms-1" onclick="event.preventDefault(); window.shopFilters.removePriceFilter()"><i class="fa-solid fa-times"></i></a></span>`;
        }

        activeFilters.innerHTML = filtersHTML;
    }

    clearAllFilters() {
        this.currentFilters = {
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
        
        this.applyFilters();
    }

    removeFilter(type, value) {
        this.currentFilters[type] = this.currentFilters[type].filter(item => item !== value);
        
        // Uncheck the checkbox
        const checkbox = document.querySelector(`input[value="${value}"]`);
        if (checkbox) checkbox.checked = false;
        
        this.applyFilters();
    }

    removePriceFilter() {
        this.currentFilters.min_price = 0;
        this.currentFilters.max_price = 10000;
        
        document.getElementById('min_price').value = 0;
        document.getElementById('max_price').value = 10000;
        
        this.applyFilters();
    }

    updateURL(queryString = '') {
        if (!queryString) {
            const tempParams = {...this.currentFilters};
            delete tempParams.page;
            queryString = new URLSearchParams(tempParams).toString();
        }
        const newUrl = `${window.location.pathname}?${queryString}`;
        window.history.replaceState(null, '', newUrl);
    }

    showLoading() {
        document.getElementById('loadingSpinner').classList.remove('d-none');
        document.getElementById('productsContainer').classList.add('d-none');
    }

    hideLoading() {
        document.getElementById('loadingSpinner').classList.add('d-none');
        document.getElementById('productsContainer').classList.remove('d-none');
    }

    showToast(type, message, showViewCart = false) {
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
                        <a href="/cart" class="btn btn-light btn-sm small text-nowrap">View Cart</a>
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
        
        let toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toastContainer';
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            document.body.appendChild(toastContainer);
        }
        
        toastContainer.appendChild(toast);
        
        const bsToast = new bootstrap.Toast(toast, {
            autohide: showViewCart ? false : true,
            delay: showViewCart ? 5000 : 3000
        });
        bsToast.show();
        
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }

    initializeTooltips() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map((tooltipTriggerEl) => {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Determine if this is a category page or shop page
    const isCategoryPage = window.location.pathname.includes('/category/');
    const categorySlug = isCategoryPage ? window.location.pathname.split('/').pop() : null;
    
    // Initialize the shop filters
    window.shopFilters = new ShopFilters({
        isCategoryPage: isCategoryPage,
        categorySlug: categorySlug
    });
});