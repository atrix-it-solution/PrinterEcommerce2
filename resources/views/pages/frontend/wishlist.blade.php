@extends('layouts.frontend.master')

@section('title', 'Wishlist')

@section('content')
<div class="bodyWrapper flex-grow-1">
    <section class="subheader py-5">
        <div class="container py-lg-5">
            <div class="row py-lg-4">
                <div class="col-md-6 text-white">
                    <h1>Wishlist</h1>
                    <p class="mb-0 fw-light">Your favorite products saved for later</p>
                </div>
                <div class="col-md-6 text-md-end text-white">
                    <div class="wishlist-summary">
                        <p class="mb-0">Items in wishlist: <strong>{{ count($wishlistItems) }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="wishlist_sec py-5">
        <div class="container py-lg-5">
            @if(count($wishlistItems) > 0)
            <div class="row">
                @foreach($wishlistItems as $item)
                <div class="col-sm-6 col-lg-4 col-xl-3 my-15">
                    <div class="product_box" data-product-id="{{ $item['product_id'] }}">
                        <a href="{{ route('product.show', $item['slug']) }}" class="product_img">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="img-fluid" />
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="img-fluid hover_img" />
                            <div class="cart_btn">
                                <button class="cusbtn cartbtn add-to-cart-from-wishlist" 
                                        data-product-id="{{ $item['product_id'] }}"
                                        data-product-title="{{ $item['title'] }}"
                                        data-product-price="{{ $item['price'] }}"
                                        data-product-image="{{ $item['image'] }}"
                                        data-product-slug="{{ $item['slug'] }}">
                                    Add to cart
                                </button>
                            </div>
                        </a>
                        <div class="product_meta">
                            @if(isset($item['sale_price']) && isset($item['regular_price']) && $item['sale_price'] < $item['regular_price'])
                                @php
                                    $discount = (($item['regular_price'] - $item['sale_price']) / $item['regular_price']) * 100;
                                @endphp
                                <div class="discount_percent">-{{ round($discount) }}%</div>
                            @endif
                            <div class="wishlist active">
                                <span class="remove-from-wishlist" 
                                      data-bs-toggle="tooltip" 
                                      data-bs-placement="top" 
                                      data-bs-custom-class="custom-tooltip" 
                                      data-bs-title="Remove From Wishlist"
                                      data-product-id="{{ $item['product_id'] }}"
                                      data-product-title="{{ $item['title'] }}">
                                    <i class="fa-solid fa-trash"></i>
                                </span>
                            </div>
                        </div>
                        <div class="product_content">
                            <h4><a href="{{ route('product.show', $item['slug']) }}">{{ $item['title'] }}</a></h4>
                            <div class="price">
                                @if(isset($item['sale_price']) && isset($item['regular_price']) && $item['sale_price'] < $item['regular_price'])
                                    <del>₹{{ number_format($item['regular_price'], 2) }}</del>
                                    <ins>₹{{ number_format($item['sale_price'], 2) }}</ins>
                                @else
                                    <ins>₹{{ number_format($item['price'], 2) }}</ins>
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
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-wishlist text-center py-5">
                <div class="empty-icon mb-4">
                    <i class="fa fa-heart fa-4x text-muted"></i>
                </div>
                <h3 class="text-muted mb-3">Your wishlist is empty</h3>
                <p class="text-muted mb-4">You haven't added any products to your wishlist yet.</p>
                <a href="{{ route('shop') }}" class="btn btn-dark btn-lg">
                    <i class="fa fa-shopping-bag me-2"></i>Start Shopping
                </a>
            </div>
            @endif
        </div>
    </div>

    @if(count($wishlistItems) > 0)
    <div class="wishlist-actions py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <a href="{{ route('shop') }}" class="btn btn-outline-dark me-3">
                        <i class="fa fa-arrow-left me-2"></i>Continue Shopping
                    </a>
                    <button class="btn btn-danger" id="clear-wishlist">
                        <i class="fa fa-trash me-2"></i>Clear Wishlist
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <hr style="opacity: .1;">

    <section class="features_sec py-5">
        <div class="container">
            <div class="row">
                <div class="col-6 col-xl-3 my-3">
                    <div class="feature_box">
                        <div class="feature_icon">
                            <img src="{{ asset('assets/frontend/images/sicon1.svg') }}" alt="Complimentary Shipping" class="img-fluid" />
                        </div>
                        <h4>Complimentary Shipping</h4>
                        <p>Free worldwide shipping and returns - customs and duties taxes included.</p>
                    </div>
                </div>
                <div class="col-6 col-xl-3 my-3">
                    <div class="feature_box">
                        <div class="feature_icon">
                            <img src="{{ asset('assets/frontend/images/sicon2.svg') }}" alt="Customer service" class="img-fluid" />
                        </div>
                        <h4>Customer service</h4>
                        <p>We are available from Monday-Friday to answer your questions.</p>
                    </div>
                </div>
                <div class="col-6 col-xl-3 my-3">
                    <div class="feature_box">
                        <div class="feature_icon">
                            <img src="{{ asset('assets/frontend/images/sicon3.svg') }}" alt="Secure payment" class="img-fluid" />
                        </div>
                        <h4>Secure payment</h4>
                        <p>Your payment information is processed securely.</p>
                    </div>
                </div>
                <div class="col-6 col-xl-3 my-3">
                    <div class="feature_box">
                        <div class="feature_icon">
                            <img src="{{ asset('assets/frontend/images/sicon4.svg') }}" alt="Contact us" class="img-fluid" />
                        </div>
                        <h4>Contact us</h4>
                        <p>Need to contact us? Send us an e-mail at support@printhelp.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@if(count($wishlistItems) > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Remove from wishlist functionality
    document.querySelectorAll('.remove-from-wishlist').forEach(icon => {
        icon.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.getAttribute('data-product-id');
            const productTitle = this.getAttribute('data-product-title');
            
            removeFromWishlist(productId, productTitle, this.closest('.product_box'));
        });
    });

    // Add to cart from wishlist
    document.querySelectorAll('.add-to-cart-from-wishlist').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.getAttribute('data-product-id');
            const productTitle = this.getAttribute('data-product-title');
            const productPrice = this.getAttribute('data-product-price');
            const productImage = this.getAttribute('data-product-image');
            const productSlug = this.getAttribute('data-product-slug');
            
            addToCartFromWishlist(productId, productTitle, productPrice, productImage, productSlug, this);
        });
    });

    // Clear entire wishlist
    document.getElementById('clear-wishlist')?.addEventListener('click', function() {
        if (confirm('Are you sure you want to clear your entire wishlist?')) {
            clearWishlist();
        }
    });

    function removeFromWishlist(productId, productTitle, element) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        fetch('{{ route("wishlist.remove") }}', {
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
                // Remove element from DOM with animation
                element.style.opacity = '0';
                element.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    element.remove();
                    
                    // Update wishlist count in header
                    if (window.updateWishlistCount) {
                        window.updateWishlistCount(data.wishlist_count);
                    }
                    
                    // Check if wishlist is empty
                    if (data.wishlist_count === 0) {
                        location.reload();
                    }
                }, 300);
                
                // Show success message
                showToast('success', productTitle + ' has been removed from your wishlist.');
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error removing from wishlist');
        });
    }

    function addToCartFromWishlist(productId, productTitle, productPrice, productImage, productSlug, button) {
        // Show loading state
        const originalText = button.textContent;
        button.textContent = 'Adding...';
        button.disabled = true;

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update cart count
                if (window.updateCartCount) {
                    window.updateCartCount(data.cart_count);
                }
                
                // Show success message
                showToast('success', productTitle + ' has been added to your cart.', true);
                
                // Reset button
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
            button.textContent = originalText;
            button.disabled = false;
        });
    }

    function clearWishlist() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Remove all items one by one (or you could create a clear all endpoint)
        const wishlistItems = document.querySelectorAll('.product_box');
        let removedCount = 0;
        
        wishlistItems.forEach(item => {
            const productId = item.getAttribute('data-product-id');
            
            fetch('{{ route("wishlist.remove") }}', {
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
                removedCount++;
                
                // Update wishlist count
                if (window.updateWishlistCount) {
                    window.updateWishlistCount(data.wishlist_count);
                }
                
                // If all items removed, reload page
                if (removedCount === wishlistItems.length) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }

    function showToast(type, message, showViewCart = false) {
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
});
</script>
@endif

@endsection