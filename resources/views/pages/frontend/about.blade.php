@extends('layouts.frontend.master')

@section('title', 'About')


@section('content')

<div class="bodyWrapper flex-grow-1">
            <section class="subheader py-5">
                <div class="container py-lg-5">
                    <div class="row py-lg-4">
                        <div class="col-md-6 text-white">
                            <h5 class="ffs mb-1 fw-light">about us</h5>
                            <h1>Our Story</h1>
                            <p class="mb-0 fw-light">Get to know our story of what values we provide and believe in</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="about_sec py-5">
                <div class="container pt-lg-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <div class="cusheading_row pb-3">
                                <h5 class="subheading ffs text-theme">it’s about your printing needs, but it’s also about your experience.</h5>
                                <h2>Reliable Printing Solutions That <br class="d-none d-lg-block"> Support Your Home & Business.</h2>
                            </div>
                            <p>We started with a simple goal: to make purchasing printers and printing supplies easy, transparent, and reliable for everyone. From home users to growing businesses, we ensure every customer gets the right printer at the right price — without confusion or compromise.</p>
                            <p>Our catalog includes top brands, trusted models, and genuine supplies, all selected to deliver high performance and long-lasting value.</p>
                            <p>We believe in offering more than just products. We offer guidance, fast delivery, real support, and a seamless shopping experience that keeps you confident from purchase to setup. With us, printing becomes simpler, smarter, and more efficient.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-5 mission-vision_sec">
                <div class="container pb-lg-5">
                    <div class="row gx-lg-0 mb-4 mb-lg-0">
                        <div class="col-lg-6">
                            <div class="img_box">
                                <img src="{{ asset('assets/frontend/images/best_collection_3.png') }}" alt="Our Mission" class="img-fluid w-100" />
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center">
                            <div class="contentbox px-0 px-lg-5 pt-4 pt-lg-5 pb-5 m-lg-4">
                                <h5 class="subheading ffs text-theme">excited</h5>
                                <h2>Our Mission</h2>
                                <p>We are dedicated to helping customers find the right printer for their home or business needs. By offering a wide range of trusted brands, competitive prices, and dependable support, our goal is to make printing easier and more accessible for everyone.</p>
                                <p>From selection to delivery, we ensure quality, transparency, and customer satisfaction at every step.</p>
                            </div>
                        </div>
                    </div>
                    <div class="rotate_text d-none d-lg-block text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 120 120" class="tab-vertical__textcircle">
                            <defs><path d="M 60, 60 m -60, 0 a 60,60 0 0,1 120,0 a 60,60 0 0,1 -120,0" id="txt-path"></path></defs>
                            <text><textPath startOffset="0" xlink:href="#txt-path">PrintHelp Trending Product</textPath></text>
                        </svg>
                    </div>
                    <div class="row gx-lg-0">
                        <div class="col-lg-6 order-lg-1">
                            <div class="img_box">
                                <img src="{{ asset('assets/frontend/images/best_collection_1.png') }}" alt="Our Vision" class="img-fluid w-100" />
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center">
                            <div class="contentbox p-3 p-lg-5 ps-0 ps-lg-0 ms-0 ms-lg-0 m-3 m-lg-4">
                                <h5 class="subheading ffs text-theme">excited</h5>
                                <h2>Our Vision</h2>
                                <p>We envision a world where buying a printer is simple, transparent, and stress-free. Our goal is to guide customers toward the right printing solution while offering top-quality brands, great prices, and reliable support.</p>
                                <p>Through innovation and dedication, we aim to become the go-to platform for printers and printing supplies.</p>                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- <section class="video_sec overflow-hidden">
                <video autoplay muted class="d-block">
                    <source src="{{ asset('assets/frontend/images/about_video.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </section> -->

           

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
                                <p>Spend just $100 and get a 50% off voucher for your next printer or accessory purchase.</p>
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
                                        <p class="desc">Excellent warranty support — I had a small hardware issue and the manufacturer handled the repair quickly after we contacted support. Smooth experience from purchase to fix.</p>
                                    </div>
                                    <div class="review_foot">
                                        <div>
                                            <h6 class="author-title">Robert Smith</h6>
                                            <p class="author-des">IT Administrator</p>
                                        </div>
                                        <div>
                                            <div class="rating">
                                                <span class="fa-solid fa-star"></span>
                                                <span class="fa-solid fa-star"></span>
                                                <span class="fa-solid fa-star"></span>
                                                <span class="fa-solid fa-star"></span>
                                                <span class="fa-regular fa-star"></span>
                                            </div>
                                            <div>(76 reviews)</div>
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
                                        <p class="desc">The consumables selection was clear and ordering replacement cartridges is simple. Print quality has been consistently sharp for our photos and proposals.</p>
                                    </div>
                                    <div class="review_foot">
                                        <div>
                                            <h6 class="author-title">Sarah Miller</h6>
                                            <p class="author-des">Marketing Manager</p>
                                        </div>
                                        <div>
                                            <div class="rating">
                                                <span class="fa-solid fa-star"></span>
                                                <span class="fa-solid fa-star"></span>
                                                <span class="fa-solid fa-star"></span>
                                                <span class="fa-solid fa-star"></span>
                                                <span class="fa-regular fa-star"></span>
                                            </div>
                                            <div>(54 reviews)</div>
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
                                        <p class="desc">Setting up network printing for our office was straightforward following the guide. The printer is stable on Wi‑Fi and shared with the whole team without issues.</p>
                                    </div>
                                    <div class="review_foot">
                                        <div>
                                            <h6 class="author-title">Daniel Brown</h6>
                                            <p class="author-des">Office Manager</p>
                                        </div>
                                        <div>
                                            <div class="rating">
                                                <span class="fa-solid fa-star"></span>
                                                <span class="fa-solid fa-star"></span>
                                                <span class="fa-solid fa-star"></span>
                                                <span class="fa-solid fa-star"></span>
                                                <span class="fa-regular fa-star"></span>
                                            </div>
                                            <div>(33 reviews)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            

            <section class="email_sec bg-theme py-5">
                <div class="container py-lg-4">
                    <div class="cusheading_row text-center pb-4">
                        <h5 class="subheading text-white mb-1 fw-light ffs">Any questions?</h5>
                        <h2 class="text-white">Send us an <b class="text-white ffs">email</b></h2>
                    </div>
                    <div class="cusform">
                        <form action="">
                            <div class="row">
                                <div class="col-md-6 my-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control rounded-0" id="name" placeholder="Full Name">
                                        <label for="name">Full Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="form-floating">
                                        <input type="email" class="form-control rounded-0" id="email" placeholder="Email Address">
                                        <label for="email">Email address</label>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control rounded-0" id="phone" placeholder="Enter Phone Number">
                                        <label for="phone">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-md-6 my-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control rounded-0" id="subject" placeholder="Enter Subject">
                                        <label for="subject">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-md-12 my-3">
                                    <div class="form-floating">
                                        <textarea class="form-control rounded-0" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                        <label for="floatingTextarea2">Comments</label>
                                    </div>
                                </div>
                                <div class="submit_btn text-center pt-2">
                                    <button type="submit" class="btn btn-dark py-3 px-5 text-uppercase rounded-0">Send Questions <i class="fa-solid fa-arrow-right ms-2"></i></button>
                                </div>
                            </div>
                        </form>
                        <p class="text-center mb-0 pt-5">This site is protected by reCAPTCHA and the Google <a href="privacy-policy" class="text-decoration-underline">Privacy Policy</a> and <a href="terms-and-conditions" class="text-decoration-underline">Terms of Service</a> apply.</p>
                    </div>
                </div>
            </section>

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
@endsection