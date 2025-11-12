@extends('layouts.frontend.master')

@section('title', $product->title . ' - ' . config('app.name'))

@section('content')
<!-- Slider Pro CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slider-pro/1.5.0/css/slider-pro.min.css" />
<!-- LightGallery CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/css/lightgallery-bundle.min.css">

<section class="product_single_sec pt-4 pb-5">
    <div class="container">
        <div class="cusbreadcrumb mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/shop">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
                </ol>
            </nav>
        </div>

        <div class="showToast d-none">
            <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <span id="toastMessage"></span> 
                        <a href="{{ route('cart.view') }}" class="btn btn-light btn-sm ms-2">View Cart</a>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>

    
        <div class="row gx-lg-5 mb-3">
            <div class="col-lg-6 my-2">
                <div class="product_gallery">
                    <div id="product-gallery" class="slider-pro">
                        <div class="sp-slides">
                             @if($product->galleryImages->count() > 0)
                                @foreach($product->galleryImages as $index => $image)
                                 <div class="sp-slide">
                                    <a href="{{ Storage::url($image->file_path) }}" class="full_icon">
                                        <i class="fa-solid fa-expand"></i>
                                    </a>
                                    <img class="sp-image img-fluid" src="{{ Storage::url($image->file_path) }}" alt="{{ $product->title }} - Image {{ $index + 1 }}" />
                                </div>
                                @endforeach
                                 @endif

                            
                            <!-- <div class="sp-slide">
                                <a href="{{ asset('assets/images/product_img1.jpg') }}" class="full_icon">
                                    <i class="fa-solid fa-expand"></i>
                                </a>
                                <img class="sp-image img-fluid" src="{{asset ('assets/images/product_img1.jpg')}}" data-src="{{asset ('assets/images/product_img1.jpg')}}" alt="Product image 1" />
                            </div>

                            
                            <div class="sp-slide">
                                <a href="{{ asset('assets/images/product_img11.jpg') }}" class="full_icon">
                                    <i class="fa-solid fa-expand"></i>
                                </a>
                                <img class="sp-image img-fluid" src="{{asset ('assets/images/product_img11.jpg')}}" data-src="{{asset ('assets/images/product_img11.jpg')}}" alt="Product image 2" />
                            </div>

                            
                            <div class="sp-slide">
                                <a href="{{ asset('assets/images/product_img2.jpg') }}" class="full_icon">
                                    <i class="fa-solid fa-expand"></i>
                                </a>
                                <img class="sp-image img-fluid" src="{{asset ('assets/images/product_img2.jpg')}}" data-src="{{asset ('assets/images/product_img2.jpg')}}" alt="Product image 3" />
                            </div>

                            
                            <div class="sp-slide">
                                <a href="{{ asset('assets/images/product_img3.jpg') }}" class="full_icon">
                                    <i class="fa-solid fa-expand"></i>
                                </a>
                                <img class="sp-image img-fluid" src="{{asset ('assets/images/product_img3.jpg')}}" data-src="{{asset ('assets/images/product_img3.jpg')}}" alt="Product image 3" />
                            </div> -->

                        </div>

                        <!-- Thumbnails -->
                        <div class="sp-thumbnails">
                             @if($product->galleryImages->count() > 0)
                                @foreach($product->galleryImages as $image)
                                <img class="sp-thumbnail img-fluid" src="{{ Storage::url($image->file_path) }}" alt="{{ $product->title }} thumbnail" />
                                @endforeach
                            @endif
                            <!-- <img class="sp-thumbnail img-fluid" src="{{asset ('assets/images/product_img1.jpg')}}" alt="Product Thumb 1" />
                            <img class="sp-thumbnail img-fluid" src="{{asset ('assets/images/product_img11.jpg')}}" alt="Product Thumb 2" />
                            <img class="sp-thumbnail img-fluid" src="{{asset ('assets/images/product_img2.jpg')}}" alt="Product Thumb 3" />
                            <img class="sp-thumbnail img-fluid" src="{{asset ('assets/images/product_img3.jpg')}}" alt="Product Thumb 3" /> -->
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 my-2">
                <div class="product_summary entry-summary">
                    <h1>{{ $product->title }}</h1>
                    <div class="stock pt-1">
                        <span class="badge border rounded-pill {{ $product->stock_quantity > 0 || is_null($product->stock_quantity) ? 'instock' : 'outofstock' }}">
                            @if(is_null($product->stock_quantity))
                                In Stock
                            @else
                                {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                            @endif
                        </span>
                    </div>
                    <div class="product-price pt-2">
                         @if($product->sale_price && $product->sale_price < $product->regular_price)
                        <p class="price">
                            <del><bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ number_format($product->regular_price, 2) }}</bdi></del>
                            <ins><bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ number_format($product->sale_price, 2) }}</bdi></ins>
                             @php
                                $discount = (($product->regular_price - $product->sale_price) / $product->regular_price) * 100;
                            @endphp
                            <span class="sale-off fw-bold">{{ round($discount) }}% OFF</span>
                        </p>
                         @else
                        <p class="price">
                            <ins><bdi><span class="woocommerce-Price-currencySymbol">$</span>{{ number_format($product->regular_price, 2) }}</bdi></ins>
                        </p>
                        @endif
                    </div>
                    <!-- <div class="short_desc pb-2">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id commodi eaque voluptatibus illo, exercitationem minus natus, doloremque amet similique in dolore non quae pariatur dolorum laboriosam qui dolores nesciunt rem!</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut illo maxime accusamus tempora veritatis dicta aperiam.</p>
                    </div> -->
                    <form class="cart mb-3" action="{{ route('cart.add') }}" method="post" id="addToCartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="product-atc-group product-type-simple d-flex flex-wrap gap-3 align-items-end">
                             @if(!is_null($product->stock_quantity) && $product->stock_quantity > 0 || is_null($product->stock_quantity))
                            <div class="product-quantity">
                                <div class="quantity__label em-font-semibold text-start">Quantity:</div>
                                <div class="quantity">
                                    <span class="icon--minus qty-button" type="button">
                                        <svg aria-hidden="true" role="img" focusable="false" width="12" height="2" viewBox="0 0 12 2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.998 1.85689H6.85519H5.1409H-0.00195312V0.142604H5.1409L6.85519 0.142578L11.998 0.142604V1.85689Z"></path>
                                        </svg>
                                    </span>
                                    <input type="number" id="quantity" class="input-text qty" name="quantity" value="1" min="1" max="{{ !is_null($product->stock_quantity) ? $product->stock_quantity : '' }}" step="1" placeholder="" inputmode="numeric" autocomplete="off">
                                    <span class="icon--plus qty-button">
                                        <svg aria-hidden="true" role="img" focusable="false" width="12" height="12" viewBox="0 0 12 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.998 6.85714H6.85519V12H5.1409V6.85714H-0.00195312V5.14286H5.1409V0H6.85519V5.14286H11.998V6.85714Z"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" name="add-to-cart" class="single_add_to_cart_button btn btn-dark" id="addToCartBtn">
                                <span class="btn-text">Add to cart</span>
                                <div class="spinner-border spinner-border-sm d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                             @else
                             <button type="button" class="btn btn-secondary" disabled>Out of Stock</button>
                            @endif
                            <div class="product_wishlist_btn">
                                <a href="#" class="wishlist-toggle" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                data-bs-custom-class="custom-tooltip" 
                                data-bs-title="Add to wishlist"
                                data-product-id="{{ $product->id }}"
                                data-product-title="{{ $product->title }}"
                                data-in-wishlist="{{ $product->isInWishlist ? 'true' : 'false' }}">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="share_product mb-2 py-2">
                        <a href="#" class="d-inline-flex align-items-center gap-2">
                            <i class="fa-solid fa-share-nodes"></i> Share
                        </a>
                    </div>

                    <div class="product_meta">
                        <div class="sku_wrapper pb-1"><span class="fw-semibold">SKU:</span> <span class="sku">{{ $product->sku }}</span></div>
                        <div class="posted_in">
                            <span class="fw-semibold">Category: </span>
                            @foreach($product->categories as $index => $category)
                                <a href="{{ route('category.show', $category->slug) }}" rel="tag">{{ $category->title }}</a>
                                @if(!$loop->last), @endif
                            @endforeach
                        </div>  
                    </div>
                </div>
            </div>
        </div>

        <div class="vsipl_tabs pt-5">
            <div class="accordion" id="productTabs">
                <div class="accordion-item">
                    <h4 class="accordion-header accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#descriptionTab" aria-expanded="false" aria-controls="descriptionTab">Description</h4>
                    <div id="descriptionTab" class="accordion-collapse collapse" data-bs-parent="#productTabs">
                        <div class="accordion-body">
                             {!! $product->description !!}
                        </div>
                    </div>
                </div>
               
                <div class="accordion-item">
                    <h4 class="accordion-header accordion-button" data-bs-toggle="collapse" data-bs-target="#reviewTab" aria-expanded="true" aria-controls="reviewTab">Reviews</h4>
                    <div id="reviewTab" class="accordion-collapse collapse show" data-bs-parent="#productTabs">
                        <div class="accordion-body">
                            <div id="reviews" class="d-flex flex-wrap gap-5">
                                <div class="product_rating">
                                    <h3>Customer Reviews</h3>
                                    <p class="noreviews opacity-75">No reviews yet.</p>
                                    <button class="form-review px-4 px-2 btn btn-outline-dark" type="button" data-bs-toggle="modal" data-bs-target="#review-form">Write a review</button>
                                </div>
                                <div id="comments">
                                    <button class="form-review px-4 px-2 btn btn-outline-dark ms-auto d-none" type="button" data-bs-toggle="modal" data-bs-target="#review-form">Write a review</button>
 
                                    <ol class="commentlist">
                                        <li class="review">
                                            <div class="comment_container">
                                                <img alt="" src="{{asset ('assets/frontend/images/user.jpg')}}" class="avatar" height="60" width="60" />
                                                <div class="comment-text">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="star-rating d-flex">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star opacity-25"></i>
                                                            <i class="fa-solid fa-star opacity-25"></i>
                                                        </div>
                                                        <p class="meta">
                                                            <strong class="review__author">aslogin </strong>
                                                            <span class="review__dash">–</span>
                                                            <time class="review__published-date">November 10, 2025</time>
                                                        </p>
                                                    </div>
                                                    <div class="description">
                                                        <p>swdqefc</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="review">
                                            <div class="comment_container">
                                                <img alt="" src="{{asset ('assets/frontend/images/user.jpg')}}" class="avatar" height="60" width="60" />
                                                <div class="comment-text">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="star-rating d-flex">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </div>
                                                        <p class="meta">
                                                            <strong class="review__author">aslogin </strong>
                                                            <span class="review__dash">–</span>
                                                            <time class="review__published-date">November 10, 2025</time>
                                                        </p>
                                                    </div>
                                                    <div class="description">
                                                        <p>Be the first to review “HP OfficeJet Pro 9110b Wireless Printer with PDL Page Descriptive Language Suppo”</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(isset($relatedProducts) && $relatedProducts->count() > 0)
<section class="related_products py-5">
    <div class="container py-lg-3">
        <div class="cusheading_row text-center pb-4">
            <h2>Related products</h2>
        </div>
        <ul class="productlist column-4">
             @foreach($relatedProducts as $relatedProduct)
            <li>
                <div class="product_box">
                    <a href="{{ route('product.show', $relatedProduct->slug) }}" class="product_img">
                          @if($relatedProduct->featuredImage)
                        <img src="{{ Storage::url($relatedProduct->featuredImage->file_path) }}" alt="{{ $product->title }}" class="img-fluid" />
                           @endif
                        <div class="cart_btn">
                            <button class="cusbtn cartbtn">Add to cart</button>
                        </div>
                    </a>
                     
                    <div class="product_meta">
                        @if($relatedProduct->sale_price && $relatedProduct->sale_price < $relatedProduct->regular_price)
                        @php
                            $discount = (($relatedProduct->regular_price - $relatedProduct->sale_price) / $relatedProduct->regular_price) * 100;
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
                        <h4><a href="{{ route('product.show', $relatedProduct->slug) }}">{{ $relatedProduct->title }}</a></h4>
                        <div class="price">
                            @if($relatedProduct->sale_price && $relatedProduct->sale_price < $relatedProduct->regular_price)
                            <del>${{ number_format($relatedProduct->regular_price, 2) }}</del>
                            <ins>${{ number_format($relatedProduct->sale_price, 2) }}</ins>
                            @else
                            <ins>${{ number_format($relatedProduct->regular_price, 2) }}</ins>
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
    </div>
</section>
@endif

<!-- Slider Pro JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slider-pro/1.5.0/js/jquery.sliderPro.min.js"></script>
<!-- LightGallery JS -->
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/plugins/zoom/lg-zoom.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script src="{{ asset('assets/frontend/js/wishlist.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity buttons functionality
    function initializeQuantityButtons() {
        const quantityInput = document.getElementById('quantity');
        const minusButton = document.querySelector('.icon--minus');
        const plusButton = document.querySelector('.icon--plus');
        
        if (!quantityInput || !minusButton || !plusButton) return;
        
        function updateButtons() {
            const currentValue = parseInt(quantityInput.value);
            const minValue = parseInt(quantityInput.min) || 1;
            const maxValue = parseInt(quantityInput.max) || Infinity;
            
            // Update minus button state
            minusButton.style.opacity = currentValue <= minValue ? '0.5' : '1';
            minusButton.style.cursor = currentValue <= minValue ? 'not-allowed' : 'pointer';
            
            // Update plus button state
            plusButton.style.opacity = currentValue >= maxValue ? '0.5' : '1';
            plusButton.style.cursor = currentValue >= maxValue ? 'not-allowed' : 'pointer';
        }
        
        // Minus button functionality
        minusButton.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            const minValue = parseInt(quantityInput.min) || 1;
            
            if (currentValue > minValue) {
                quantityInput.value = currentValue - 1;
                updateButtons();
            }
        });
        
        // Plus button functionality
        plusButton.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            const maxValue = parseInt(quantityInput.max) || Infinity;
            
            if (currentValue < maxValue) {
                quantityInput.value = currentValue + 1;
                updateButtons();
            }
        });
        
        // Input validation
        quantityInput.addEventListener('change', function() {
            let currentValue = parseInt(this.value);
            const minValue = parseInt(this.min) || 1;
            const maxValue = parseInt(this.max) || Infinity;
            
            if (isNaN(currentValue) || currentValue < minValue) {
                this.value = minValue;
            } else if (currentValue > maxValue) {
                this.value = maxValue;
            }
            
            updateButtons();
        });
        
        // Input event for real-time validation
        quantityInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        
        // Initialize button states
        updateButtons();
    }
    
    initializeQuantityButtons();

    // Add to cart functionality
     const addToCartForm = document.getElementById('addToCartForm');
    if (addToCartForm) {
        addToCartForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('addToCartBtn');
            const btnText = submitBtn.querySelector('.btn-text');
            const spinner = submitBtn.querySelector('.spinner-border');
            const quantityInput = document.getElementById('quantity');
            
            // Show loading state
            btnText.textContent = 'Adding...';
            spinner.classList.remove('d-none');
            submitBtn.disabled = true;
            
            try {
                // Get CSRF token safely
                const csrfToken = document.querySelector('meta[name="csrf-token"]') ? 
                    document.querySelector('meta[name="csrf-token"]').getAttribute('content') : 
                    '{{ csrf_token() }}';
                
                // Submit form via AJAX
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: new FormData(this)
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Server error');
                }

                if (data.success) {
                    // Show success message with "View Cart" button
                    showStaticToast('success', '{{ $product->title }} has been added to your cart.', true); 
                    
                    // Update cart count in header
                    updateCartCount(data.cart_count);
                    
                    // Reset form quantity
                    if (quantityInput) {
                        quantityInput.value = 1;
                    }
                    
                    // Update button to show "View Cart"
                    setTimeout(() => {
                        btnText.textContent = 'View Cart';
                        submitBtn.classList.remove('btn-dark');
                        submitBtn.classList.add('btn-success');
                        submitBtn.type = 'button';
                        submitBtn.onclick = function() {
                            window.location.href = '{{ route("cart.view") }}';
                        };
                        spinner.classList.add('d-none');
                    }, 1000);
                    
                } else {
                    showStaticToast('error', data.message);
                    // Reset button state on error
                    btnText.textContent = 'Add to cart';
                    spinner.classList.add('d-none');
                    submitBtn.disabled = false;
                }

            } catch (error) {
                console.error('Error:', error);
                let errorMessage = 'Something went wrong. Please try again.';
                
                if (error.message.includes('Server error')) {
                    errorMessage = error.message;
                }
                
                showStaticToast('error', errorMessage);
                
                // Reset button state on error
                btnText.textContent = 'Add to cart';
                spinner.classList.add('d-none');
                submitBtn.disabled = false;
            }
        });
    }
});


// Show/hide static toast function
function showStaticToast(type, message, showViewCart = false) {
    const toastContainer = document.querySelector('.showToast');
    const toastMessage = document.getElementById('toastMessage');
    const toastElement = toastContainer.querySelector('.toast');
    
    if (!toastContainer || !toastMessage) return;
    
    // Update toast content
    toastMessage.textContent = message;
    
    // Update toast color based on type
    toastElement.className = `toast align-items-center text-bg-${type === 'success' ? 'success' : 'danger'} border-0`;
    
    // Show the toast container
    toastContainer.classList.remove('d-none');
    
    // Initialize and show Bootstrap toast
    const bsToast = new bootstrap.Toast(toastElement, {
        autohide: true,
        delay: 50000
    });
    bsToast.show();
    
    // Hide container when toast is hidden
    toastElement.addEventListener('hidden.bs.toast', () => {
        toastContainer.classList.add('d-none');
    });
}



// Load cart count on page load
document.addEventListener('DOMContentLoaded', function() {
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
});

// Slider Pro initialization
jQuery(document).ready(function($) {
    $('#product-gallery').sliderPro({
        width: '100%',
        height: 650,
        fade: true,
        arrows: true,
        buttons: false,
        thumbnailsPosition: 'bottom',
        thumbnailWidth: 153,
        thumbnailHeight: 153,
        thumbnailArrows: true,
        touchSwipe: true,
        responsive: true,
        autoScaleLayers: true,
        imageScaleMode: 'contain',
        shuffle: false,
        autoplay: false
    });

    // Initialize LightGallery
    lightGallery(document.getElementById('product-gallery'), {
        selector: '.sp-slide a',
        thumbnail: true,
        zoom: true,
        download: false,
        actualSize: false,
        fullScreen: true
    });
});
</script>
@endsection