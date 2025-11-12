@extends('layouts.frontend.master')

@section('title', 'Home')

@section('content')

<div class="bodyWrapper flex-grow-1">
    <section class="hero_section overflow-hidden">
        <div class="hero_slider common_slider">
            <div>
                <div class="hero_slide_box">
                    <a href="javascript:void(0);" class="slide_link"></a>
                    <div class="slide_img">
                        <img src="{{ asset('assets/frontend/images/printer_banner.png') }}" alt="PrintHelp" class="img-fluid w-100" />
                    </div>
                </div>
            </div>
            <div>
                <div class="hero_slide_box">
                    <a href="javascript:void(0);" class="slide_link"></a>
                    <div class="slide_img">
                        <img src="{{ asset('assets/frontend/images/printer_banner.png') }}" alt="PrintHelp" class="img-fluid w-100" />
                    </div>
                </div>
            </div>
            <div>
                <div class="hero_slide_box">
                    <a href="javascript:void(0);" class="slide_link"></a>
                    <div class="slide_img">
                        <img src="{{ asset('assets/frontend/images/printer_banner.png') }}" alt="PrintHelp" class="img-fluid w-100" />
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="category_sec py-5">
        <div class="container">
            <div class="row">
                @foreach($categories as $index => $category)
                <div class="col-md-6 col-xl-3 my-3">
                     <div class="cat_box">
                        <a href="{{ route('category.show', $category->slug) }}" class="cat_img p-4">
                            <img src="{{ asset($category->categoryImage->url) }}" alt="Grocery" class="img-fluid" />
                        </a>
                        <div class="cat_content  d-flex flex-column justify-content-between">
                            <div class="cat-heading">
                                <h4><a href="{{ route('category.show', $category->slug) }}">{{ $category->title }}  </a></h4>
                                <p>{{ $category->products_count ?? 0 }} items</p>
                            </div>
                            <div class="cat-btn">
                                <a href="{{ route('category.show', $category->slug) }}" class=" d-inline-block">Shop now <i class="fa-solid fa-arrow-up"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- <div class="col-md-6 col-xl-3 my-3">
                     <div class="cat_box">
                        <a href="#" class="cat_img p-4">
                             <img src="{{ asset('assets/frontend/images/cat_2.jpg') }}" alt="Garments" class="img-fluid" />
                        </a>
                        <div class="cat_content  d-flex flex-column justify-content-between">
                            <div class="cat-heading">
                                <h4><a href="#">Envy Printers</a></h4>
                            <p>4 items</p>
                            </div>
                            <div class="cat-btn">
                                <a href="#" class=" d-inline-block">Shop now <i class="fa-solid fa-arrow-up"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 my-3">
                     <div class="cat_box">
                        <a href="#" class="cat_img p-4">
                             <img src="{{ asset('assets/frontend/images/cat_3.jpg') }}" alt="Food Essentials" class="img-fluid" />
                        </a>
                        <div class="cat_content  d-flex flex-column justify-content-between">
                            <div class="cat-heading">
                                 <h4><a href="#">Laserjet Printers</a></h4>
                            <p>2 items</p>
                            </div>
                            <div class="cat-btn">
                                <a href="#" class=" d-inline-block">Shop now <i class="fa-solid fa-arrow-up"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 my-3">
                     <div class="cat_box">
                        <a href="#" class="cat_img p-4">
                            <img src="{{ asset('assets/frontend/images/cat_4.jpg') }}" alt="Accessories" class="img-fluid" />
                        </a>
                        <div class="cat_content  d-flex flex-column justify-content-between">
                            <div class="cat-heading">
                                <h4><a href="#">Officejet Printers</a></h4>
                            <p>5 items</p>
                            </div>
                            <div class="cat-btn">
                                <a href="#" class=" d-inline-block">Shop now <i class="fa-solid fa-arrow-up"></i> </a>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <section class="features_sec py-5">
        <div class="container">
            <div class="row">
                <div class="col-6 col-xl-3 my-3">
                    <div class="feature_box">
                        <div class="feature_icon">
                            <img src="{{ asset('assets/frontend/images/icon1.png') }}" alt="Free shipping" class="img-fluid" />
                        </div>
                        <h4>Free shipping</h4>
                        <p>You will love at great low prices</p>
                    </div>
                </div>
                <div class="col-6 col-xl-3 my-3">
                    <div class="feature_box">
                        <div class="feature_icon">
                            <img src="{{ asset('assets/frontend/images/icon2.png') }}" alt="Flexible payment" class="img-fluid" />
                        </div>
                        <h4>Flexible payment</h4>
                        <p>Pay with multiple credit cards</p>
                    </div>
                </div>
                <div class="col-6 col-xl-3 my-3">
                    <div class="feature_box">
                        <div class="feature_icon">
                            <img src="{{ asset('assets/frontend/images/icon3.png') }}" alt="14 days returns" class="img-fluid" />
                        </div>
                        <h4>14 days returns</h4>
                        <p>Within 30 days exchanges</p>
                    </div>
                </div>
                <div class="col-6 col-xl-3 my-3">
                    <div class="feature_box">
                        <div class="feature_icon">
                            <img src="{{ asset('assets/frontend/images/icon4.png') }}" alt="Money guarantee" class="img-fluid" />
                        </div>
                        <h4>Money guarantee</h4>
                        <p>100% money-back assurance</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product_sec overflow-hidden py-5">
        <div class="container">
            <div class="cusheading_row pb-4">
                <h2>Trending <b class="ffs">Products</b></h2>
                <p>Grab the latest trending printers — preorder today and unlock exclusive deals & bonus gifts!</p>

            </div>
            @if($products->count() > 0)
            <div class="product_slider new_arrival_slider common_slider">
                 @include('partials.product_slider', ['products' => $products])
                <!-- <div>
                    <div class="product_box">
                        <a href="#" class="product_img">
                            <img src="{{ asset('assets/frontend/images/product2.png') }}" alt="Product Name" class="img-fluid" />
                            <img src="{{ asset('assets/frontend/images/product2.png') }}" alt="Product Name" class="img-fluid hover_img" />
                            <div class="cart_btn">
                                <button class="cusbtn cartbtn">Add to cart</button>
                            </div>
                        </a>
                        <div class="product_meta">
                            <div class="discount_percent">-30%</div>
                            <div class="wishlist">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Add to Wishlist"><i class="fa-regular fa-heart"></i></span>
                            </div>
                        </div>
                        <div class="product_content">
                            <h4><a href="#">HP OfficeJet Pro 8135e Wireless All-in-One Printer</a></h4>
                            <div class="price">
                                <del>$149.00</del>
                                <ins>$129.00</ins>
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
                <div>
                    <div class="product_box">
                        <a href="#" class="product_img">
                            <img src="{{ asset('assets/frontend/images/product3.png') }}" alt="Product Name" class="img-fluid" />
                            <img src="{{ asset('assets/frontend/images/product3.png') }}" alt="Product Name" class="img-fluid hover_img" />
                            <div class="cart_btn">
                                <button class="cusbtn cartbtn">Add to cart</button>
                            </div>
                        </a>
                        <div class="product_meta">
                            <div class="discount_percent">-20%</div>
                            <div class="wishlist">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Add to Wishlist"><i class="fa-regular fa-heart"></i></span>
                            </div>
                        </div>
                        <div class="product_content">
                            <h4><a href="#">HP OfficeJet Pro 9125e All-in-One Printer</a></h4>
                            <div class="price">
                                <del>$180.00</del>
                                <ins>$109.00</ins>
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
                <div>
                    <div class="product_box">
                        <a href="#" class="product_img">
                            <img src="{{ asset('assets/frontend/images/product4.png') }}" alt="Product Name" class="img-fluid" />
                            <img src="{{ asset('assets/frontend/images/product5.png') }}" alt="Product Name" class="img-fluid hover_img" />
                            <div class="cart_btn">
                                <button class="cusbtn cartbtn">Add to cart</button>
                            </div>
                        </a>
                        <div class="product_meta">
                            <div class="discount_percent">-30%</div>
                            <div class="wishlist">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Add to Wishlist"><i class="fa-regular fa-heart"></i></span>
                            </div>
                        </div>
                        <div class="product_content">
                            <h4><a href="#">HP Color LaserJet Pro MFP 3301fdw Wireless Printer</a></h4>
                            <div class="price">
                                <del>$70.00</del>
                                <ins>$49.00</ins>
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
                <div>
                    <div class="product_box">
                        <a href="#" class="product_img">
                            <img src="{{ asset('assets/frontend/images/product5.png') }}" alt="Product Name" class="img-fluid" />
                            <img src="{{ asset('assets/frontend/images/product5.png') }}" alt="Product Name" class="img-fluid hover_img" />
                            <div class="cart_btn">
                                <button class="cusbtn cartbtn">Add to cart</button>
                            </div>
                        </a>
                        <div class="product_meta">
                            <div class="discount_percent">-20%</div>
                            <div class="wishlist">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Go to Wishlist"><i class="fa-solid fa-heart"></i></span>
                            </div>
                        </div>
                        <div class="product_content">
                            <h4><a href="#">HP LaserJet Pro MFP 3101sdw Printer</a></h4>
                            <div class="price">
                                <del>$77.00</del>
                                <ins>$47.00</ins>
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
                <div>
                    <div class="product_box">
                        <a href="#" class="product_img">
                            <img src="{{ asset('assets/frontend/images/product6.png') }}" alt="Product Name" class="img-fluid" />
                            <img src="{{ asset('assets/frontend/images/product6.png') }}" alt="Product Name" class="img-fluid hover_img" />
                            <div class="cart_btn">
                                <button class="cusbtn cartbtn">Add to cart</button>
                            </div>
                        </a>
                        <div class="product_meta">
                            <div class="discount_percent">-30%</div>
                            <div class="wishlist">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Add to Wishlist"><i class="fa-regular fa-heart"></i></span>
                            </div>
                        </div>
                        <div class="product_content">
                            <h4><a href="#">(Renewed) HP DeskJet 4155e All-in-One Wireless Color Inkjet Printer</a></h4>
                            <div class="price">
                                <del>$80.00</del>
                                <ins>$39.00</ins>
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
                </div> -->
            </div>
            @else
            <div class="text-center py-5">
                <p class="text-muted">No Trending products found.</p>
            </div>
            @endif
        </div>
    </section>

    <section class="py-5 best-collections_sec">
        <div class="container">
            <div class="row gx-lg-0 mb-4 mb-lg-0">
                <div class="col-lg-6">
                    <div class="img_box">
                        <img src="{{ asset('assets/frontend/images/product_21.png') }}" alt="sustainability" class="img-fluid w-100" />
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="contentbox px-0 px-lg-5 pt-4 pt-lg-5 pb-5 m-lg-4">
                        <h5 class="subheading ffs text-theme">Sustainability</h5>
                        <h2>Supporting eco-friendly printing choices.</h2>
                        <p>As a trusted printer seller, we promote products that are energy-efficient, durable, and designed with lower environmental impact. By offering printers that use less power, support recycled cartridges, and reduce overall waste, we help customers choose smarter, more sustainable printing solutions.</p>
                        <div class="cusbtn pt-3">
                            <a href="#" class="btn btn-dark px-5 py-3">Discover More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rotate_text d-none d-lg-block text-center">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 120 120" class="tab-vertical__textcircle">
                    <defs>
                        <path d="M 60, 60 m -60, 0 a 60,60 0 0,1 120,0 a 60,60 0 0,1 -120,0" id="txt-path"></path>
                    </defs>
                    <text>
                        <textPath startOffset="0" xlink:href="#txt-path"> PrintHelp Trending Product</textPath>
                    </text>
                </svg>
            </div>
            <div class="row gx-lg-0">
                <div class="col-lg-6 order-lg-1">
                    <div class="tab-content" id="pills-tabContent">
                        @foreach($categories as $index => $category)
                                <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" 
                                    id="pills-category-{{ $category->id }}" 
                                    role="tabpanel" 
                                    aria-labelledby="pills-category-{{ $category->id }}-tab" 
                                    tabindex="0">
                                    <div class="img_box">
                                        @if($category->categoryImage)
                                            <img src="{{ asset($category->categoryImage->url) }}" alt="{{ $category->title }}" class="img-fluid w-100" />
                                        @else
                                           
                                            <img src="{{ asset('assets/frontend/images/best_collection_' . ($index + 1) . '.png') }}" alt="{{ $category->title }}" class="img-fluid w-100" />
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                        <!-- <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                    <div class="img_box">
                                        <img src="{{ asset('assets/frontend/images/best_collection_2.png') }}" alt="Essentials" class="img-fluid w-100" />
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                                    <div class="img_box">
                                        <img src="{{ asset('assets/frontend/images/best_collection_3.png') }}" alt="Lookbook" class="img-fluid w-100" />
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">
                                    <div class="img_box">
                                        <img src="{{ asset('assets/frontend/images/best_collection_4.png') }}" alt="Perfect Office Style" class="img-fluid w-100" />
                                    </div>
                                </div> -->
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="contentbox p-3 p-lg-5 ps-0 ps-lg-0 ms-0 ms-lg-0 m-3 m-lg-4">
                        <h5 class="subheading fw-normal text-dark pb-lg-3 text-uppercase text-theme"><small>Best Collections</small></h5>
                        <ul class="list-unstyled m-0" id="pills-tab" role="tablist">
                            @foreach($categories as $index => $category)
                                    <li class="nav-item pb-2 pb-lg-4 mb-2" role="presentation">
                                        <h2 class="nav-link ffs {{ $index == 0 ? 'active' : '' }}" 
                                            id="pills-category-{{ $category->id }}-tab" 
                                            data-bs-toggle="pill" 
                                            data-bs-target="#pills-category-{{ $category->id }}" 
                                            role="tab" 
                                            aria-controls="pills-category-{{ $category->id }}" 
                                            aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                            <a href="javascript:void(0);">{{ $category->title }}</a>
                                        </h2>
                                    </li>
                                    @endforeach
                            <!-- <li class="nav-item pb-2 pb-lg-4 mb-2" role="presentation">
                                        <h2 class="nav-link ffs" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><a href="javascript:void(0);">Envy Printers</a></h2>
                                    </li>
                                    <li class="nav-item pb-2 pb-lg-4 mb-2" role="presentation">
                                        <h2 class="nav-link ffs" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><a href="javascript:void(0);">Deskjet Printers</a></h2>
                                    </li>
                                    <li class="nav-item pb-2 pb-lg-4 mb-2" role="presentation">
                                        <h2 class="nav-link ffs" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" role="tab" aria-controls="pills-disabled" aria-selected="false"><a href="javascript:void(0);">Laserjet Printers</a></h2>
                                    </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product_sec best-seller overflow-hidden py-5">
        <div class="container pb-lg-5">
            <div class="cusheading_row pb-4">
                <h2>Best <b class="ffs">Seller</b></h2>
                <p>Shop our best-selling printers and enjoy exclusive offers on top models.</p>
            </div>
            @if($products->count() > 0)
            <div class="product_slider best_seller_slider common_slider">
                @include('partials.product_slider', ['products' => $products])
            </div>
            @else
            <div class="text-center py-5">
                <p class="text-muted">No best-selling products found.</p>
            </div>
            @endif


        </div>
    </section>

    <section class="subscribe_sec bg-light py-5">
        <div class="container py-lg-3">
            <div class="row align-items-center">
                <div class="col-lg-6 my-2">
                    <h3>Subscribe and get $5 off your next order!</h3>
                    <p>Get the latest deals, new printer launches, and exclusive promotions delivered to your inbox — plus enjoy savings on your next order.</p>
                    <p>*Valid once per customer. Terms apply.</p>

                </div>
                <div class="col-lg-6 my-2">
                    <div class="subcribe_text">

                        <form action="">
                            <div class="form-group mb-3">
                                <label for="name" class="d-none">Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="d-none">Email Address</label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Email Address">
                            </div>
                            <div class="submitbtn">
                                <button type="submit" class="btn btn-dark cusbtn w-100">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="sale_sec py-5">
        <div class="container py-lg-4">
            <div class="row align-items-center">
                <div class="col-lg-6 my-2">
                    <div class="sale_banner text-center">
                        <img src="{{ asset('assets/frontend/images/offer-banner.png') }}" alt="Offers" class="img-fluid" />
                    </div>
                </div>
                <div class="col-lg-6 my-2">
                    <div class="sale_content text-center">
                        <h5 class="subheading ffs text-theme">Super offer</h5>
                        <h2 class="text-uppercase py-2">Winter sale</h2>
                        <h4 class="pb-3">Up to 20% off</h4>
                        <p>Spend just $100 and get a 20% off voucher for your next printer or accessory purchase.</p>
                        <div class="cusbtn pt-4">
                            <a href="#" class="btn btn-dark px-5 py-3">Discover More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="review_sec overflow-hidden py-5">
        <div class="container">
            <div class="cusheading_row pb-4">
                <h2>Customer <b class="ffs">Reviews</b></h2>
            </div>
            <div class="testimonial_slider common_slider">
                <div>
                    <div class="review_box">
                        <!-- <a href="javascript:void(0);" class="review_img">
                                    <img src="{{ asset('assets/frontend/images/review-1.jpg') }}" alt="Review" class="img-fluid" />
                                </a> -->
                        <div class="review_content">
                            <div class="review_content_inner">
                                <span><i class="fa-solid fa-quote-left"></i></span>
                                <p class="desc">I ordered an office printer for my small business — setup was straightforward and the prints look professional. Customer support helped with a quick toner recommendation. Very satisfied.</p>
                            </div>
                            <div class="review_foot">
                                <div>
                                    <h6 class="author-title">Jessica Carter</h6>
                                    <p class="author-des">Small Business Owner</p>
                                </div>
                                <div>
                                    <div class="rating">
                                        <span class="fa-solid fa-star"></span>
                                        <span class="fa-solid fa-star"></span>
                                        <span class="fa-solid fa-star"></span>
                                        <span class="fa-solid fa-star"></span>
                                        <span class="fa-solid fa-star"></span>
                                    </div>
                                    <div>(128 reviews)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="review_box">
                        <!-- <a href="javascript:void(0);" class="review_img">
                                    <img src="{{ asset('assets/frontend/images/review-2.jpg') }}" alt="Review" class="img-fluid" />
                                </a> -->
                        <div class="review_content">
                            <div class="review_content_inner">
                                <span><i class="fa-solid fa-quote-left"></i></span>
                                <p class="desc">Fast shipping and excellent packaging — the printer arrived in perfect condition. Ink efficiency has been much better than my previous model; we're saving on consumables.</p>
                            </div>
                            <div class="review_foot">
                                <div>
                                    <h6 class="author-title">Michael Johnson</h6>
                                    <p class="author-des">Operations Manager</p>
                                </div>
                                <div>
                                    <div class="rating">
                                        <span class="fa-solid fa-star"></span>
                                        <span class="fa-solid fa-star"></span>
                                        <span class="fa-solid fa-star"></span>
                                        <span class="fa-solid fa-star"></span>
                                        <span class="fa-regular fa-star"></span>
                                    </div>
                                    <div>(64 reviews)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="review_box">
                        <!-- <a href="javascript:void(0);" class="review_img">
                                    <img src="{{ asset('assets/frontend/images/review-1.jpg') }}" alt="Review" class="img-fluid" />
                                </a> -->
                        <div class="review_content">
                            <div class="review_content_inner">
                                <span><i class="fa-solid fa-quote-left"></i></span>
                                <p class="desc">Bought a refurbished laser printer — it arrived like new and performs flawlessly. Support helped register the warranty quickly. Highly recommend for budget-conscious buyers.</p>
                            </div>
                            <div class="review_foot">
                                <div>
                                    <h6 class="author-title">Emily Davis</h6>
                                    <p class="author-des">Freelance Designer</p>
                                </div>
                                <div>
                                    <div class="rating">
                                        <span class="fa-solid fa-star"></span>
                                        <span class="fa-solid fa-star"></span>
                                        <span class="fa-solid fa-star"></span>
                                        <span class="fa-solid fa-star"></span>
                                        <span class="fa-regular fa-star"></span>
                                    </div>
                                    <div>(42 reviews)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<script src="{{ asset('assets/frontend/js/wishlist.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add to Cart functionality for home page products
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const productId = this.getAttribute('data-product-id');
            const productTitle = this.getAttribute('data-product-title');
            const productPrice = this.getAttribute('data-product-price');
            const productImage = this.getAttribute('data-product-image');
            const productSlug = this.getAttribute('data-product-slug');
            
            addToCart(productId, productTitle, productPrice, productImage, productSlug, this);
        });
    });

    function addToCart(productId, productTitle, productPrice, productImage, productSlug, button) {
        // Show loading state
        const originalText = button.textContent;
        button.textContent = 'Adding...';
        button.disabled = true;

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]') ? 
            document.querySelector('meta[name="csrf-token"]').getAttribute('content') : 
            '{{ csrf_token() }}';

        // Send AJAX request to add to cart
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
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update cart count
                updateCartCount(data.cart_count);
                
                // Show success message
                showToast('success', productTitle + ' has been added to your cart.', true);
                
                // Reset button after delay
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
            
            // Reset button
            button.textContent = originalText;
            button.disabled = false;
        });
    }

    function updateCartCount(count) {
        const cartCountElements = document.querySelectorAll('.cart-count-badge, .header-cart .count');
        cartCountElements.forEach(element => {
            element.textContent = count;
            if (count > 0) {
                element.style.display = 'inline';
            } else {
                element.style.display = 'none';
            }
        });
    }

    function showToast(type, message, showViewCart = false) {
        // Create toast element
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
            autohide: showViewCart ? false : true,
            delay: showViewCart ? 5000 : 3000
        });
        bsToast.show();
        
        // Remove toast from DOM after hide
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }

    // Load cart count on page load
    function loadCartCount() {
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
    }

    // Initialize cart count
    loadCartCount();
});



</script>

@endsection