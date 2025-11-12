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
                   
                        <div class="product-atc-group product-type-simple d-flex flex-wrap gap-3 align-items-end">
                         
                        <button 
                                type="button" 
                                name="get_a_quote" 
                                class="single_add_to_cart_button btn btn-dark" 
                                id="quoteButton" 
                                data-bs-toggle="modal" 
                                data-bs-target="#quoteFormModal" 
                                data-product-id="{{ $product->id }}"
                                data-product-name="{{ $product->title }}"
                                data-product-price="${{ number_format($product->sale_price ?? $product->regular_price, 2) }}"
                                data-product-url="{{ route('product.show', $product->slug) }}"
                                >
                                <span class="btn-text">Get a Quote</span>
                            </button>
                           
                        </div>
                  

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
                    <h4 class="accordion-header accordion-button " data-bs-toggle="collapse" data-bs-target="#descriptionTab" aria-expanded="true" aria-controls="descriptionTab">Description</h4>
                    <div id="descriptionTab" class="accordion-collapse collapse show" data-bs-parent="#productTabs">
                        <div class="accordion-body">
                            {!! $product->description !!}
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
        <ul class="productlist column-lg-4 col-6">
            @foreach($relatedProducts as $relatedProduct)
            <li>
                <div class="product_box">
                    <a href="{{ route('product.show', $relatedProduct->slug) }}" class="product_img">
                        @if($relatedProduct->featuredImage)
                        <img src="{{ Storage::url($relatedProduct->featuredImage->file_path) }}" alt="{{ $product->title }}" class="img-fluid" />
                        @endif
                        <div class="cart_btn">
                            <button class="cusbtn cartbtn">View</button>
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
            autoplay: false,


            breakpoints: {
                1024: { // LG se niche (tablet and small screen)
                    height: 450
                },
                768: { // MD screens
                    height: 400
                },
                576: { // SM screens
                    height: 350
                }
            }
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