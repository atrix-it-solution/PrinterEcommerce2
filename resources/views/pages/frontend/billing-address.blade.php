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
                                        <!-- <img src="images/dummy.jpg" alt="User Name" class="img-fluid"/> -->
                                    </div>
                                    <div class="user_info_r">
                                        <h4>Rajat Bansal</h4>
                                        <div class="email">rajatatrix@gmail.com</div>
                                    </div>
                                </div>
                                <ul class="account-menu list-unstyled">
                                    <li><a href="my-account"><i class="fa-solid fa-grip"></i> <span>Dashboard</span></a></li>
                                    <li><a href="orders" class=""><i class="fa-solid fa-bag-shopping"></i> <span>My Orders</span></a></li>
                                    <li><a href="wishlist"><i class="fa-solid fa-heart"></i> <span>My Wishlist</span></a></li>
                                    <li><a href="edit-address" class="active"><i class="fa-solid fa-address-card"></i> <span>Address</span></a></li>
                                    <li><a href="edit-account"><i class="fa-solid fa-user"></i> <span>Account Details</span></a></li>
                                    <li><a href="#"><i class="fa-solid fa-sign-out"></i> <span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 my-2">
                            <div class="account_right_side">
                                <div class="profile_page">
                                    <h2 class="acc_heading pb-3">Billing Address</h2>
                                    <div class="account_form">
                                        <form action="">
                                            <div class="row">
                                                <div class="form-group col-lg-6 mb-3">
                                                    <label for="billing_fname">First Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="billing_fname" id="billing_fname" placeholder="" value="" required />
                                                </div>
                                                <div class="form-group col-lg-6 mb-3">
                                                    <label for="billing_lname">Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="billing_lname" id="billing_lname" placeholder="" value="" required />
                                                </div>
                                                <div class="form-group col-lg-12 mb-3">
                                                    <label for="billing_company_name">Company Name (Optional)</label>
                                                    <input type="text" class="form-control" name="billing_company_name" id="billing_company_name" placeholder="" value="" />
                                                </div>

                                                <div class="form-group col-lg-12 mb-3 pb-2">
                                                    <label for="billing_country">Country / Region <span class="text-danger">*</span></label>
                                                    <select name="billing_country" id="billing_country" class="form-control">
                                                        <option value="">Select Country</option>
                                                        <option value="India">India</option>
                                                        <option value="Canada">Canada</option>
                                                        <option value="Australia">Australia</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group col-lg-12 mb-3">
                                                    <label for="billing_streetaddress1">Street Address <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="billing_streetaddress1" id="billing_streetaddress1" placeholder="House number and street name" value="" required />
                                                </div>
                                                <div class="form-group col-lg-12 mb-3">
                                                    <label for="billing_streetaddress2" class="d-none">Street Address</label>
                                                    <input type="text" class="form-control" name="billing_streetaddress2" id="billing_streetaddress2" placeholder="Apartment, suite, unit, etc. (optional)" value="" />
                                                </div>

                                                <div class="form-group col-lg-6 mb-3">
                                                    <label for="billing_town_city">Town / City <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="billing_town_city" id="billing_town_city" placeholder="" value="" required />
                                                </div>
                                                <div class="form-group col-lg-6 mb-3">
                                                    <label for="billing_postcode">Postcode <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="billing_postcode" id="billing_postcode" placeholder="" value="" required />
                                                </div>
                                                <div class="form-group col-lg-6 mb-3">
                                                    <label for="billing_phonenumber">Phone Number (Optional)</label>
                                                    <input type="text" class="form-control" name="billing_phonenumber" id="billing_phonenumber" placeholder="" value="" />
                                                </div>
                                                <div class="form-group col-lg-6 mb-3">
                                                    <label for="billing_email">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="billing_email" id="billing_email" placeholder="" value="" required />
                                                </div>
                                            </div>
                                            <div class="submit_btn pt-2">
                                                <button type="submit" class="btn btn-dark py-3 text-uppercase px-5">Save Changes</button>
                                            </div>
                                        </form>
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