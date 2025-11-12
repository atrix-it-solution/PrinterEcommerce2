@extends('layouts.frontend.master')

@section('title', 'Home')

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
                                    <h2 class="acc_heading pb-3">My Orders</h2>
                                    <div class="order_table table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr class="text-uppercase">
                                                    <td class="fw-semibold small opacity-50">Order ID</td>
                                                    <td class="fw-semibold small opacity-50">Date</td>
                                                    <td class="fw-semibold small opacity-50">Status</td>
                                                    <td class="fw-semibold small opacity-50">Total</td>
                                                    <td class="fw-semibold small opacity-50" width="130px">Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="view-order" class="fw-semibold">#6888</a>
                                                    </td>
                                                    <td>October 14, 2025</td>
                                                    <td>
                                                        <span class="badge text-uppercase fw-semibold rounded-pill bg-secondary">Processing</span>
                                                    </td>
                                                    <td>
                                                        $590.99 for 1 item
                                                    </td>
                                                    <td class="">
                                                        <a href="view-order" class="text-decoration-underline me-2">View</a>
                                                        <a href="#" class="text-decoration-underline">Invoice</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="view-order" class="fw-semibold">#6888</a>
                                                    </td>
                                                    <td>October 14, 2025</td>
                                                    <td>
                                                        <span class="badge text-uppercase fw-semibold rounded-pill bg-success">Completed</span>
                                                    </td>
                                                    <td>
                                                        $590.99 for 1 item
                                                    </td>
                                                    <td class="">
                                                        <a href="view-order" class="text-decoration-underline me-2">View</a>
                                                        <a href="#" class="text-decoration-underline">Invoice</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="view-order" class="fw-semibold">#6888</a>
                                                    </td>
                                                    <td>October 14, 2025</td>
                                                    <td>
                                                        <span class="badge text-uppercase fw-semibold rounded-pill bg-secondary">Processing</span>
                                                    </td>
                                                    <td>
                                                        $590.99 for 1 item
                                                    </td>
                                                    <td class="">
                                                        <a href="view-order" class="text-decoration-underline me-2">View</a>
                                                        <a href="#" class="text-decoration-underline">Invoice</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="view-order" class="fw-semibold">#6888</a>
                                                    </td>
                                                    <td>October 14, 2025</td>
                                                    <td>
                                                        <span class="badge text-uppercase fw-semibold rounded-pill bg-danger">Cancelled</span>
                                                    </td>
                                                    <td>
                                                        $590.99 for 1 item
                                                    </td>
                                                    <td class="">
                                                        <a href="view-order" class="text-decoration-underline me-2">View</a>
                                                        <a href="#" class="text-decoration-underline">Invoice</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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