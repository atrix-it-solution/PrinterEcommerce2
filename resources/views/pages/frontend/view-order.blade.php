@extends('layouts.frontend.master')

@section('title', 'View Order')

@section('content')
        <div class="bodyWrapper flex-grow-1">
            <section class="subheader py-5" style="background-image: url('images/account_bg.jpg');">
                <div class="container py-lg-5">
                    <div class="row">
                        <div class="col-md-6 text-white">
                            <h1 class="text-dark">My Account</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="myaccount_sec py-5">
                <div class="container">
                    <div class="row gx-lg-5">
                        <div class="col-lg-3 my-2">
                            <div class="account_sidebar">
                                <div class="user_info mb-3 d-flex gap-2">
                                    <div class="user_img">
                                        <span>RB</span>
                                        <!-- <img src="{{ asset('assets/frontend/images/dummy.jpg') }}" alt="User Name" class="img-fluid"/> -->
                                    </div>
                                    <div class="user_info_r">
                                        <h4>Rajat Bansal</h4>
                                        <div class="email">rajatatrix@gmail.com</div>
                                    </div>
                                </div>
                                <ul class="account-menu list-unstyled">
                                    <li><a href="my-account"><i class="fa-solid fa-grip"></i> <span>Dashboard</span></a></li>
                                    <li><a href="orders" class="active"><i class="fa-solid fa-bag-shopping"></i> <span>My Orders</span></a></li>
                                    <li><a href="/wishlist"><i class="fa-solid fa-heart"></i> <span>My Wishlist</span></a></li>
                                    <li><a href="edit-address"><i class="fa-solid fa-address-card"></i> <span>Address</span></a></li>
                                    <li><a href="edit-account"><i class="fa-solid fa-user"></i> <span>Account Details</span></a></li>
                                    <li><a href="#"><i class="fa-solid fa-sign-out"></i> <span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 my-2">
                            <div class="account_right_side">
                                <div class="order_page">
                                    <h2 class="acc_heading pb-3">Orders Details</h2>
                                    <p>Order <mark class="rounded-pill px-2">#6876</mark> was placed on <mark class="rounded-pill px-2">October 14, 2025</mark> and is currently <span class="badge bg-secondary fw-normal rounded-pill fs-14">Processing</span>.</p>
                                    <div class="view_order_table table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>Product</td>
                                                    <td class="text-end">Total</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="#">Product Name</a> <strong>× <span class="total_item">1</span></strong>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="price">$149..99</div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td>Subtotal:</td>
                                                    <td class="text-end fs-5 fw-semibold">$149.99</td>
                                                </tr>
                                                <tr>
                                                    <td>Total:</td>
                                                    <td class="text-end fs-5 fw-semibold">$149.99</td>
                                                </tr>
                                                <tr>
                                                    <td>Payment method:</td>
                                                    <td class="text-end">Cash on delivery</td>
                                                </tr>
                                                <tr>
                                                    <td>Actions:</td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-dark px-4 text-uppercase fs-7 py-2">Invoice</a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="billing_address shadow p-4 border border-light mt-4 rounded-3">
                                        <h4 class="pb-2">Billing address</h4>
                                        <address class="mb-0">
                                            testing <br> test test <br>7467 <br>tesat <br>testing 140307 <br>Chandigarh, India <br>978675432 <br>atrixitsolution2025@gmail.com
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            


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
        @endsection