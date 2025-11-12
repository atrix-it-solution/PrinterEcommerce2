@extends('layouts.frontend.master')

@section('title', 'Home')

@section('content')
<div class="bodyWrapper flex-grow-1">
    <!-- ========== Start Product overview ========== -->
    <section class="product-overview my-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="product-breadcumb">
                        <a href="#">Home</a> <span><i class="fa-solid fa-angle-right"></i></span>
                        <a href="#" class=" text-uppercase">OfficeJet Printers</a> <span><i class="fa-solid fa-angle-right"></i></span>
                        <span>HP OfficeJet Pro 8025 All-in-One Wireless Printer</span>
                    </div>
                </div>
            </div>
            <div class="row gx-5 gy-5">
                <div class="col-lg-6">
                    <div class="product-img-sec position-relative">

                        <div class="row gx-4">
                            <div class="col-2 order-2 order-lg-1">
                                <div thumbsSlider="" class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 order-1 order-lg-2">
                                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff; position:relative; overflow:hidden;" class="swiper mySwiper2">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img class="zoomImage" src="https://swiperjs.com/demos/images/nature-1.jpg" id="zoomImage"  data-zoom-image="https://swiperjs.com/demos/images/nature-1.jpg" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img class="zoomImage" src="https://swiperjs.com/demos/images/nature-2.jpg" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img class="zoomImage" src="https://swiperjs.com/demos/images/nature-3.jpg" />
                                        </div>
                                    
                                    </div>
                                    <div class="swiper-button-next"><i class="fa-solid fa-angle-right"></i></div>
                                    <div class="swiper-button-prev"><i class="fa-solid fa-angle-left"></i></div>
                                </div>
                            </div>
                        </div>
                        <!-- Swiper -->

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-short-desc">
                        <div class="product-cat">
                            <span>Category:</span>
                            <a href="#">OfficeJet Printers</a>
                        </div>
                        <h1 class="product-title my-3">HP OfficeJet Pro 8025 All-in-One Wireless Printer</h1>
                        <div class="stock-tag my-3">
                            <span class="in-stock">In Stock</span>
                        </div>
                        <div class="my-3">
                            <p class="product-price">$299.99</p>
                        </div>
                        <div class="add-cart">
                            <p>Quantity:</p>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="quantity">
                                        <span class="quantity-btn"><i class="fa-solid fa-minus"></i></span>
                                        <span>1</span>
                                        <span class="quantity-btn"><i class="fa-solid fa-plus"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-8 d-flex align-items-center">
                                    <div class="flex-grow-1"><button class="btn btn-dark cusbtn  add-cart w-100 flex-grow-1">Add to cart - <span>$299.99</span> </button></div>
                                    <div class="wishlist-btn mx-2"><i class="fa-regular fa-heart"></i></div>
                                    <div class="compare-btn mx-2"><i class="fa-solid fa-code-compare"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="share-product my-4">
                            <a href="#"><i class="fa-solid fa-share-nodes"></i> <span> Share</span></a>
                        </div>
                        <div class="product-other-info my-4">
                            <p class="mb-0"><span class=" fw-medium">SKU:</span> 403X0A#B1H</p>
                            <p class="mb-0"><span class=" fw-medium">Category:</span> OFFICEJET PRINTERS</p>
                        </div>
                        <div class="delivery-details my-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="delivery-details-card">
                                        <div class="icon">
                                            <i class="fa-solid fa-ship"></i>
                                        </div>
                                        <p class="text-center">Estimate delivery times: 12-26 days (International), 3-6 days (United States).</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="delivery-details-card">
                                        <div class="icon">
                                            <i class="fa-solid fa-rotate-left"></i>

                                        </div>
                                        <p class="text-center"> Return within 30 days of purchase. Duties & taxes are non-refundable.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="payment-sec">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="d-flex align-items-center">
                                        <div class="icon me-3 mb-2"><i class="fa-solid fa-user-shield"></i></div>
                                        <p>Guarantee Safe Checkout</p>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="img-box">
                                        <img src="{{ asset('assets/frontend/images/payments.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== End Product overview ========== -->

    <!-- ========== Start Prooduct Description ========== -->
    <div class="product-description my-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Tabs -->
                    <ul class="nav  nav-underline  px-3">
                        <li class="nav-item">
                            <a class="nav-link py-3 active" data-bs-toggle="tab" href="#description">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-3" data-bs-toggle="tab" href="#reviews">
                                Reviews (0)
                            </a>
                        </li>
                    </ul>
                    <!-- Tab Content -->
                    <div class="tab-content p-4">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description">
                            <h4>Description</h4>
                            <p>product description...</p>
                        </div>
                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>Customer Reviews</h4>
                                <button class="btn btn-outline-dark rounded-pill px-4">
                                    Write a review
                                </button>
                            </div>
                            <p class="text-muted">No reviews yet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== End Prooduct Description ========== -->


</div>


@endsection