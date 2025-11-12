@extends('layouts.frontend.master')

@section('title', 'Blog')

@section('content')
        <div class="bodyWrapper flex-grow-1">
            <section class="subheader py-5">
                <div class="container py-lg-5">
                    <div class="row py-lg-4">
                        <div class="col-md-6 text-white">
                            <h1>Our Blog</h1>
                            <p class="mb-0 fw-light">Get to know any questions of what values we provide and believe in</p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="blog_sec py-5">
                <div class="container py-lg-5">
                    <div class="row gx-lg-4">
                        <div class="col-md-6 col-lg-4 my-3">
                            <div class="blog_box h-100 d-flex flex-column overflow-hidden rounded-3 bg-white shadow-lg p-2 border">
                                <a href="single-blog" class="blog_img">
                                    <img src="{{ asset('assets/frontend/images/product7.png') }}" alt="How to Choose a Printer" class="img-fluid h-100 w-100 object-fit-cover" />
                                </a>
                                <div class="blog_content flex-grow-1 d-flex flex-column p-3 px-2">
                                    <h4 class="fw-normal"><a href="single-blog">How to Choose the Right Printer for Your Business</a></h4>
                                    <p class="mb-1 text-muted small">Nov 7, 2025 • Buying Guide</p>
                                    <p class="pb-1">Learn how to match printer features to your office needs — print volume, multifunction options, network features and total cost of ownership explained.</p>
                                    <div class="readmore mt-auto">
                                        <a href="single-blog" class="cusbtn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 my-3">
                            <div class="blog_box h-100 d-flex flex-column overflow-hidden rounded-3 bg-white shadow-lg p-2 border">
                                <a href="single-blog" class="blog_img">
                                    <img src="{{ asset('assets/frontend/images/product7.png') }}" alt="Inkjet vs Laser" class="img-fluid h-100 w-100 object-fit-cover" />
                                </a>
                                <div class="blog_content flex-grow-1 d-flex flex-column p-3 px-2">
                                    <h4 class="fw-normal"><a href="single-blog">Inkjet vs Laser: Which Is Right for You?</a></h4>
                                    <p class="mb-1 text-muted small">Oct 30, 2025 • Comparison</p>
                                    <p class="pb-1">A quick comparison of inkjet and laser printers — speed, print quality, running costs and which type fits different use-cases like photos, documents, or high-volume printing.</p>
                                    <div class="readmore mt-auto">
                                        <a href="single-blog" class="cusbtn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 my-3">
                            <div class="blog_box h-100 d-flex flex-column overflow-hidden rounded-3 bg-white shadow-lg p-2 border">
                                <a href="single-blog" class="blog_img">
                                    <img src="{{ asset('assets/frontend/images/product7.png') }}" alt="Eco-Friendly Printing" class="img-fluid h-100 w-100 object-fit-cover" />
                                </a>
                                <div class="blog_content flex-grow-1 d-flex flex-column p-3 px-2">
                                    <h4 class="fw-normal"><a href="single-blog">Eco-Friendly Printing: Save Money & Reduce Waste</a></h4>
                                    <p class="mb-1 text-muted small">Jun 10, 2025 • Sustainability</p>
                                    <p class="pb-1">Small changes to how you print can reduce costs and environmental impact. Learn about duplex printing, draft modes, recycling cartridges and choosing energy-efficient printers.</p>
                                    <div class="readmore mt-auto">
                                        <a href="single-blog" class="cusbtn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 my-3">
                            <div class="blog_box h-100 d-flex flex-column overflow-hidden rounded-3 bg-white shadow-lg p-2 border">
                                <a href="single-blog" class="blog_img">
                                    <img src="{{ asset('assets/frontend/images/product7.png') }}" alt="Printer Maintenance" class="img-fluid h-100 w-100 object-fit-cover" />
                                </a>
                                <div class="blog_content flex-grow-1 d-flex flex-column p-3 px-2">
                                    <h4 class="fw-normal"><a href="single-blog">Printer Maintenance: 7 Tips to Extend Your Printer's Life</a></h4>
                                    <p class="mb-1 text-muted small">Sep 12, 2025 • Maintenance</p>
                                    <p class="pb-1">Keep your printer running longer with simple maintenance: cleaning, firmware updates, correct consumables and regular usage tips to avoid clogs and hardware issues.</p>
                                    <div class="readmore mt-auto">
                                        <a href="single-blog" class="cusbtn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 my-3">
                            <div class="blog_box h-100 d-flex flex-column overflow-hidden rounded-3 bg-white shadow-lg p-2 border">
                                <a href="single-blog" class="blog_img">
                                    <img src="{{ asset('assets/frontend/images/product7.png') }}" alt="Cartridges vs Compatible" class="img-fluid h-100 w-100 object-fit-cover" />
                                </a>
                                <div class="blog_content flex-grow-1 d-flex flex-column p-3 px-2">
                                    <h4 class="fw-normal"><a href="single-blog">Original vs Compatible Cartridges: What You Should Know</a></h4>
                                    <p class="mb-1 text-muted small">Aug 5, 2025 • Consumables</p>
                                    <p class="pb-1">Understand the trade-offs between OEM and compatible cartridges — cost, print quality, and warranty considerations so you can choose the right supplies for your needs.</p>
                                    <div class="readmore mt-auto">
                                        <a href="single-blog" class="cusbtn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 my-3">
                            <div class="blog_box h-100 d-flex flex-column overflow-hidden rounded-3 bg-white shadow-lg p-2 border">
                                <a href="single-blog" class="blog_img">
                                    <img src="{{ asset('assets/frontend/images/product7.png') }}" alt="Network Printing" class="img-fluid h-100 w-100 object-fit-cover" />
                                </a>
                                <div class="blog_content flex-grow-1 d-flex flex-column p-3 px-2">
                                    <h4 class="fw-normal"><a href="single-blog">Setting Up Network Printing: A Quick Guide</a></h4>
                                    <p class="mb-1 text-muted small">Jul 20, 2025 • How-to</p>
                                    <p class="pb-1">Step-by-step setup for connecting your printer to Wi‑Fi or wired networks, sharing printers across a team, and troubleshooting common connection problems.</p>
                                    <div class="readmore mt-auto">
                                        <a href="single-blog" class="cusbtn">Read More <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="pagination cuspagination mt-4 pt-4 gap-1 justify-content-center">
                        <li class="disabled"><a href="#"><i class="fa-solid fa-arrow-left"></i></a></li>
                        <li class="page_item active"><a href="#">1</a></li>
                        <li class="page_item"><a href="#">2</a></li>
                        <li class="page_item"><a href="#">3</a></li>
                        <li class="page_item dots"><span>...</span></li>
                        <li class="page_item"><a href="#">7</a></li>
                        <li class="page_item"><a href="#">8</a></li>
                        <li><a href="#"><i class="fa-solid fa-arrow-right"></i></a></li>
                    </ul>
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