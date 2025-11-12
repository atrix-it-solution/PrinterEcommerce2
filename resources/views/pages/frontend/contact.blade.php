@extends('layouts.frontend.master')

@section('title', 'Contact Us')

@section('content')
        <div class="bodyWrapper flex-grow-1">
            <section class="contact_sec bg-light">
                <div class="row gx-0">
                    <div class="col-lg-6">
                        <div class="contactimg h-100">
                            <img src="{{ asset('assets/frontend/images/contactimg.jpg') }}" alt="Contact printhelp" class="img-fluid h-100 w-100 object-fit-cover" />
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="contactright p-5">
                            <div class="cusheading_row">
                                <h5 class="ffs subheading text-theme">Questions?</h5>
                                <h1>We're here to help with sizing, stylingand anything else, 3 Year Warranty, Extended 90 Day Returns, Expedited Shipping</h1>
                            </div>
                            <div class="cusbtn pt-4">
                                <a href="#"><button class="btn btn-dark rounded-0 px-5" type="button">Read Faqs <i class="fa-solid fa-arrow-right"></i> </button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="email_sec py-5">
                <div class="container py-lg-4">
                    <div class="cusheading_row text-center pb-4">
                        <h5 class="subheading mb-1 fw-light ffs">Any questions?</h5>
                        <h2 class="">Send us an <b class="ffs">email</b></h2>
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

            <section class="map_sec position-relative overflow-hidden">
                <div class="container py-5 my-5">
                    <div class="map_text bg-white shadow">
                        <h3 class="pb-2">Contact Info</h3>
                        <ul class="list-unstyled infobox d-flex flex-column">
                            <li class="border-bottom"><a class="d-flex" href="tel:+919876543210"><i class="fa-solid text-theme fa-phone"></i> +91 98765-43210</a></li>
                            <li class="border-bottom"><a class="d-flex" href="mailto:info@printhelp.com"><i class="fa-regular text-theme fa-envelope"></i> info@printhelp.com</a></li>
                            <li class="border-bottom"><a class="d-flex" href="javascript:void(0);"><i class="fa-solid text-theme fa-map-marker-alt"></i> 1901 thorn ridge cir. shiloh, hawai 81063</a></li>
                            <li class=""><a class="d-flex" href="javascript:void(0);"><i class="fa-regular text-theme fa-clock"></i> We are an online store, so you can shop 24 hours a day!</a></li>
                        </ul>
                        <ul class="social_menu mb-0 list-unstyled gap-2">
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="map_box position-absolute h-100 w-100">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d27444.613585414278!2d76.6971184!3d30.702183999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1758029668413!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="d-block"></iframe>
                </div>
            </section>

            <div class="faq_sec py-5">
                <div class="container py-lg-5">
                    <div class="cusheading_row text-center pb-4">
                        <h5 class="subheading mb-1 text-theme fw-light ffs">Frequently Asked Questions</h5>
                        <h2 class="">Here are some common questions</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="cusfaq">
                                <div class="accordion accordion-flush bg-transparent" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h5 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">How long will shipping take?</h5>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Most orders are dispatched within 24–48 hours. Delivery time depends on your location and shipping option, but every order includes full tracking from our warehouse to your doorstep. </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">How do I know if my order is confirmed?</h5>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Once your order is placed, you’ll receive an order confirmation email with all details. You can also track your order status anytime by logging into your account.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">Can I change my shipping address after my order is placed?</h5>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Yes, you can request an address change before the order is shipped. Just contact our support team as soon as possible. Once the package is dispatched, we may not be able to modify the address.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">Do your printers come with a warranty?</h5>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Yes, every printer includes the official manufacturer warranty, usually ranging from 1 to 3 years depending on the brand. Extended warranty options are available for selected models.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">Do you offer installation or setup assistance?</h5>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Yes, we provide printer setup guidance through online support. We help you install drivers, connect to Wi-Fi, and configure print settings for both PC and mobile.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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