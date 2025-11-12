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

        function applyFilters() {
            showLoading();
            
            // Remove page parameter when filters change
            const { page, ...filtersWithoutPage } = currentFilters;
            
            const queryString = new URLSearchParams();
            
            // Add filters to query string
            Object.keys(filtersWithoutPage).forEach(key => {
                if (Array.isArray(filtersWithoutPage[key]) && filtersWithoutPage[key].length > 0) {
                    filtersWithoutPage[key].forEach(value => {
                        queryString.append(`${key}[]`, value);
                    });
                } else if (!Array.isArray(filtersWithoutPage[key]) && filtersWithoutPage[key]) {
                    queryString.append(key, filtersWithoutPage[key]);
                }
            });

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
                updateProducts(data.products);
                updatePagination(data.pagination);
                updateTotalProducts(data.total_products);
                updateActiveFilters();
                updateURL(queryString.toString());
                hideLoading();
            })
            .catch(error => {
                console.error('Error applying filters:', error);
                hideLoading();
            });
        }

        function updateProducts(products) {
            const container = document.getElementById('productsContainer');
            
            if (products.length === 0) {
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
                productsHTML += `
                    <li>
                        <div class="product_box">
                            <a href="${product.url}" class="product_img">
                                <img src="${product.image}" alt="${product.title}" class="img-fluid" />
                                <img src="${product.image}" alt="${product.title}" class="img-fluid hover_img" />
                                <div class="cart_btn">
                                    <button class="cusbtn cartbtn">Add to cart</button>
                                </div>
                            </a>
                            <div class="product_meta">
                                ${product.discount ? `<div class="discount_percent">-${product.discount}%</div>` : ''}
                                <div class="wishlist">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Add to Wishlist">
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
        }

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
                        // Use the page URL from pagination data
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
                updateProducts(data.products);
                updatePagination(data.pagination);
                updateTotalProducts(data.total_products);
                updateActiveFilters();
                updateURL(new URL(url).search);
                hideLoading();
            })
            .catch(error => {
                console.error('Error loading page:', error);
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
                delete tempParams.page; // Remove page from URL
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