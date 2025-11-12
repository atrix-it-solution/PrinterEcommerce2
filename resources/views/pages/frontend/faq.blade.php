@extends('layouts.frontend.master')

@section('title', 'FAQ')

@section('content')
        <div class="bodyWrapper flex-grow-1">
            <section class="subheader py-5">
                <div class="container py-lg-5">
                    <div class="row py-lg-4">
                        <div class="col-md-6 text-white">
                            <h1>FAQ's</h1>
                            <p class="mb-0 fw-light">Get to know any questions of what values we provide and believe in</p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="faq_sec py-5">
                <div class="container py-lg-5">
                    <div class="cusheading_row text-center pb-4">
                        <h5 class="subheading mb-1 text-theme fw-light ffs">Frequently Asked Questions</h5>
                        <h2 class="">Here are some common questions</h2>
                    </div>
                    <div class="row gx-lg-1 justify-content-between">
                        <div class="col-lg-5">
                            <div class="cusfaq">
                                <div class="accordion accordion-flush bg-transparent" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h5 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">Where do the printers you sell come from?</h5>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">No — we are a reseller and retailer that sells printers from multiple trusted brands. We do not manufacture printers. Manufacturer warranties and service policies apply; we will assist you with warranty claims and returns according to our store policy.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">What warranty comes with a printer?</h5>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Most new printers include a manufacturer warranty (commonly 1 year—check the product page for exact terms). For refurbished or open-box items, seller warranty details will be listed on the product page. Warranty repairs are generally handled by the manufacturer or their authorized service centers; we can help initiate claims.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">How do I request repairs or technical support for my printer?</h5>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">We provide pre-sales guidance, basic setup help and troubleshooting. For hardware repairs and advanced technical support, please contact the manufacturer's authorized service center. We can assist by providing contact details and helping coordinate the process.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="cusfaq">
                                <div class="accordion accordion-flush bg-transparent" id="accordionFlushExample1">
                                    <div class="accordion-item">
                                        <h5 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">Are the printers new or refurbished?</h5>
                                        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample1">
                                            <div class="accordion-body">Each product page clearly states whether a printer is new, open-box, or refurbished. Refurbished units are inspected and tested; the product listing will describe the condition and any included accessories. Please read the product description before purchasing.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">Do the printers use original cartridges/toner and are compatible supplies available?</h5>
                                        <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample1">
                                            <div class="accordion-body">Most printers use brand-specific cartridges or toners. The product page lists compatible consumables and part numbers. We sell both original (OEM) and compatible third-party supplies—choose based on your quality and budget preferences. Using non-recommended supplies can affect print quality and warranty in some cases; see the product page for details.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">What are your shipping, returns and order change policies?</h5>
                                        <div id="flush-collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample1">
                                            <div class="accordion-body">Orders are confirmed by email once payment is processed and typically ship within the timeframe shown on the product page. You can change your shipping address only before the order is dispatched—contact support as soon as possible. Returns for unopened or unused items are accepted within the period stated in our Returns Policy; defective items are handled via warranty or replacement per the manufacturer's process. For any order or return help, contact support@printhelp.com and include your order number.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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